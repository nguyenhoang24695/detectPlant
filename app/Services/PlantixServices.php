<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/23/2021
 * Time: 9:26 AM
 */

namespace App\Services;


use App\Constants\CommonConstant;
use App\Constants\PlantixConstant;
use App\Models\CropCategoryStage;
use App\Models\CropManager;
use App\Models\CropPathogen;
use App\Models\CropPathogenBiochemicalDrug;
use App\Models\CropPathogenMethodGeneral;
use App\Models\CropPathogenStage;
use App\Models\IdentifyResult;
use App\Models\IdentifyUser;
use App\Models\MstPathogen;
use App\Models\PathogenInstructionDrug;
use App\Models\PlantPathogen;
use App\Utils\CommonUtil;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class PlantixServices
{
    /**
     *  Tạo mới danh tính khi gửi request lên plantix
     */
    public static function CreateIdentity($image_name)
    {
        // Đọc file Json Gốc
        $original_json = file_get_contents(storage_path() . "/app/public/base.json");
        $data = json_decode($original_json, true);
        $data["user_id"] = CommonUtil::GenerateGuid();
        $data["pic_id"] = CommonUtil::GenerateGuid();
        $data["pla_id"] = CommonUtil::GenerateGuid();
        $data["date"] = Carbon::now()->format("Ymd_His");
        $data["file_name"] = "None";
        file_put_contents(storage_path() . "/app/public/temp.json", json_encode($data));
    }

    /**
     * @throws GuzzleException
     */
    public static function ImageAnalysis(IdentifyUser $identifyUser, string $image_url): array
    {
        $client = new Client(['base_uri' => PlantixConstant::BASE_URL]);
        $res = $client->request('POST', PlantixConstant::IMAGE_ANALYSIS_URL, [
            'multipart' => [
                [
                    'name' => 'picture',
                    'contents' => Psr7\Utils::tryFopen($image_url, "r")
                ]
            ],
            'headers' => ['Api-Key' => env("PLANTIX_KEY")]
        ]);
        $raw_data = $res->getBody()->getContents();
        return PlantixServices::ProcessData(json_decode($raw_data, true), $identifyUser);
    }

    /**
     * Xử lý dữ liệu nhận được từ Plantix
     */
    public static function ProcessData($data, IdentifyUser $identifyUser): array
    {
        // Lấy dữ liệu cây nếu plantix trả về chính xác cây
        $crop = CropManager::query()
            ->where('host', $data["plant_net"][0]["name"])
            ->get()
            ->first();
        if (isset($crop)) {

            $crop_data_list = DataServices::GetCropDataFromFromScientificName($crop->science_name);
            $plantix_result = new IdentifyResult();
            $plantix_result->identify_user_id = $identifyUser->id;
            $plantix_result->type = CommonConstant::TYPE_CROP;
            $plantix_result->note = CommonConstant::PLANTIX_STRING;
            $plantix_result->scientific_name = $crop["scientific_name"];

            $plantix_result->save();
        }

        // Dữ liệu bệnh
        $res = $data["image_analysis"];
        $pathogen_data_list = [];

        foreach ($res as $key => $value) {

            $plantix_result = new IdentifyResult();
            $plantix_result->identify_user_id = $identifyUser->id;
            $plantix_result->type = CommonConstant::TYPE_PATHOGEN;
            $plantix_result->note = CommonConstant::PLANTIX_STRING;
            $plantix_result->scientific_name = $value["scientific_name"];

            $plantix_result->save();

            // Lấy dữ liệu bệnh
            $pathogen_data = DataServices::GetDiseaseDataFromScientificName($value["scientific_name"]);
            array_push($pathogen_data_list, $pathogen_data);

        }
        $identifyUser->pathogen_indentify_status = $data["recognized_bool"] ? 1 : 0;
        if (isset($crop_data_list)) {

            return ["pathogen_data" => $pathogen_data_list, "crop_data" => $crop_data_list];
        }
        return ["pathogen_data" => $pathogen_data_list];
    }
}
