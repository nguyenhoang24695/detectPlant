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
use App\Models\IdentifyResult;
use App\Models\IdentifyUser;
use App\Models\MstPathogen;
use App\Models\PlantPathogen;
use App\Utils\CommonUtil;
use Carbon\Carbon;
use GuzzleHttp\Client;
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function ImageAnalysis(IdentifyUser $identifyUser, string $image_url): array
    {
        $client = new Client(['base_uri' => PlantixConstant::BASE_URL]);;
        $response = $client->request('POST', PlantixConstant::IMAGE_ANALYSIS_URL, [
            'multipart' => [
                [
                    'name' => 'picture',
                    'contents' => Psr7\Utils::tryFopen($image_url, "r")
                ]
            ],
            'headers' => ['Api-Key' => env("PLANTIX_KEY")]
        ]);
        $raw_data = $response->getBody()->getContents();
        return PlantixServices::ProcessData(json_decode($raw_data, true), $identifyUser);
    }

    /**
     * Xử lý dữ liệu nhận được từ Plantix
     */
    public static function ProcessData($data, IdentifyUser $identifyUser): array
    {
        $response = $data["image_analysis"];
        $plant_net = $data["plant_net"];
        $result = [];
        foreach ($response as $key => $res) {


            $plant = MstPathogen::query()->where("peat_id", "=", $res["peat_id"])->first();
            if ($plant != null) {
                $response[$key]["name_vi"] = $plant["name"];
            }

            $plantix_result = new IdentifyResult();
            $plantix_result->identify_user_id = $identifyUser->id;
            $plantix_result->type = CommonConstant::TYPE_PATHOGEN;
            $plantix_result->source = CommonConstant::PLANTIX_STRING;
            $plantix_result->scientific_name = $res["scientific_name"];

            $plantix_result->save();
        }
        $identifyUser->pathogen_indentify_status = $data["recognized_bool"] ? 1 : 0;

        return ["plant_net" => $plant_net, "response" => $response,];
    }
}
