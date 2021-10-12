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
use App\Models\IdentifyResult;
use App\Models\IdentifyUser;
use App\Models\MstCrop;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class PlantIdService
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function SendRequest(IdentifyUser $identifyUser, $image_url)
    {
        $client = new Client(['base_uri' => PlantIdConstant::BASE_URL]);;
        $response = $client->request('POST', PlantIdConstant::UPLOAD_URL,
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
        $raw_data = $response->getBody()->getContents();
        return PlantIdService::ProcessData($identifyUser, json_decode($raw_data, true));
    }

    /**
     * Xử lý dữ liệu nhận được từ PlantId
     * @param $raw_data
     * @return mixed
     */
    public static function ProcessData(IdentifyUser $identifyUser, $raw_data)
    {
        $result = $raw_data["suggestions"];
        foreach ($result as $key => $item) {
            $plant_data = MstCrop::query()
                ->where('scientific_name', 'like', $item["plant_details"]["scientific_name"] . '%')
                ->first();

            if (isset($plant_data)) {
                $plant_data = $plant_data->toArray();
                $result[$key]["plant_details"]["global_name"] = $plant_data["common_name"];
            }

            if ($key == 0) {

                $plantId_result = new IdentifyResult();
                $plantId_result->identify_user_id = $identifyUser->id;
                $plantId_result->type = CommonConstant::TYPE_CROP;
                $plantId_result->source = CommonConstant::PLANTID_STRING;
                $plantId_result->scientific_name = $item["plant_details"]["scientific_name"];

                $plantId_result->save();
            }
        }
        $identifyUser->crop_indentify_status = 1;
        return $result;
    }

    static function ImageToBase64($image): string
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image));
        return $base64;
    }
}
