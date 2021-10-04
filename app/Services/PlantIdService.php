<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/27/2021
 * Time: 9:38 AM
 */

namespace App\Services;


use App\Constants\PlantIdConstant;
use App\Models\PlantData;
use GuzzleHttp\Client;

class PlantIdService
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function SendRequest($data)
    {
        $client = new Client(['base_uri' => PlantIdConstant::BASE_URL]);;
        $response = $client->request('POST', PlantIdConstant::UPLOAD_URL,
            [
                'json' => [
                    "images" => [PlantIdService::ImageToBase64($data["image_url"])],
                    "modifiers" => ["crops_medium"],
                    "plant_details" => ["common_names", "url", "wiki_description"],
                    "plant_language" => "vi"
                ],
                'headers' => [
                    "Content-Type" => "application/json",
                    "Api-Key" => "QCBrW4Dpjy7hszCUa7U9keNLfxHzNPRDF5uB7qfKTiwAXqnzLI"
                ]
            ]);
        $raw_data = $response->getBody()->getContents();
        return PlantIdService::ProcessData($data, json_decode($raw_data, true));
    }

    /**
     * Xử lý dữ liệu nhận được từ PlantId
     * @param $plantixData
     * @param $raw_data
     * @return mixed
     */
    public static function ProcessData($plantixData, $raw_data)
    {
        $result = $raw_data["suggestions"];
        foreach ($result as $key => $item) {
            $plant_data = PlantData::query()
                ->where('scientific_name_with_author','like',$item["plant_details"]["scientific_name"].'%')
                ->first();

            if (isset($plant_data)){
                $plant_data = $plant_data->toArray();
                $result[$key]["plant_details"]["global_name"] = $plant_data["common_name"];
            }
        }
        return $result;
    }

    static function ImageToBase64($image): string
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image));
        return $base64;
    }
}
