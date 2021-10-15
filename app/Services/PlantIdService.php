<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/27/2021
 * Time: 9:38 AM
 */

namespace App\Services;


use App\Constants\CommonConstant;
use App\Constants\PlantIdConstant;
use App\Models\CropManager;
use App\Models\IdentifyResult;
use App\Models\IdentifyUser;
use App\Models\MstCrop;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;

class PlantIdService
{
    /**
     * @throws GuzzleException
     */
    public static function ImageAnalysis(IdentifyUser $identifyUser, $image_url): array
    {
        $client = new Client(['base_uri' => PlantIdConstant::BASE_URL]);;
        $res = $client->request('POST', PlantIdConstant::UPLOAD_URL,
            [
                'json' => [
                    "images" => [PlantIdService::ImageToBase64($image_url)],
                    "modifiers" => ["crops_medium"],
                    "plant_details" => ["common_names", "url", "wiki_description"],
                    "plant_language" => "vi"
                ],
                'headers' => [
                    "Content-Type" => "application/json",
                    "Api-Key" => env("PLANTID_KEY")
                ]
            ]);
        $raw_data = $res->getBody()->getContents();
        return PlantIdService::ProcessData($identifyUser, json_decode($raw_data, true));
    }

    /**
     * Xử lý dữ liệu nhận được từ PlantId
     * @param $raw_data
     * @return array
     */
    public static function ProcessData(IdentifyUser $identifyUser, $raw_data): array
    {

        $result = $raw_data["suggestions"];
        $crop_data_list = [];
        foreach ($result as $key => $item) {

            // Lưu thông tin kết quả nhận diện
            $plantId_result = new IdentifyResult();
            $plantId_result->identify_user_id = $identifyUser->id;
            $plantId_result->type = CommonConstant::TYPE_CROP;
            $plantId_result->note = CommonConstant::PLANTID_STRING;
            $plantId_result->scientific_name = $item["plant_details"]["scientific_name"];
            $plantId_result->save();

            //Lưu crop nếu chưa tồn tại trong mst_crop
            $crop = CropManager::query()
                ->where('science_name', $item["plant_details"]["scientific_name"])
                ->first();
            if (!isset($crop)) {
                $new_crop = new CropManager();
                $new_crop->science_name = $item["plant_details"]["scientific_name"];
                $new_crop->crop_name = $item["plant_details"]["common_names"][0] ?? 'Unknown';
                $new_crop->status = 0;
                $new_crop->field_group = 1;

                $new_crop->save();
            }
            $crop_data = DataServices::GetCropDataFromFromScientificName($item["plant_details"]["scientific_name"]);
            array_push($crop_data_list, $crop_data);

            //Chỉ lưu kêt quả đầu tiên nhận được từ plantId => break
            break;
        }

        $identifyUser->crop_indentify_status = 1;
        return ["crop_data" => $crop_data_list];
    }

    static function ImageToBase64($image): string
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image));
        return $base64;
    }
}
