<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/23/2021
 * Time: 9:26 AM
 */

namespace App\Services;


use App\Constants\PlantixConstant;
use App\Models\PlantPathogen;
use App\Utils\CommonUtil;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

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
    public static function SendRequest($image)
    {
        PlantixServices::CreateIdentity($image->getClientOriginalName());
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $image->move(public_path() ."/", "picture" . $type);
        $image_url = public_path()  . "/picture" . $type;
        $client = new Client(['base_uri' => PlantixConstant::BASE_URL]);;
        $response = $client->request('POST', PlantixConstant::UPLOAD_URL, [
            'multipart' => [
                [
                    'name' => 'json',
                    'contents' => Psr7\Utils::tryFopen(storage_path() . "/app/public/temp.json", "r")
                ],
                [
                    'name' => 'picture',
                    'contents' => Psr7\Utils::tryFopen($image_url, "r")
                ]
            ],
            'headers' => ['username' => 'PEAT', 'password' => 'v2xERzGBcrRJ6bUj']
        ]);
        $raw_data = $response->getBody()->getContents();

        return PlantixServices::ProcessData(json_decode($raw_data, true), $image_url);
    }

    /**
     * Xử lý dữ liệu nhận được từ Plantix
     */
    public static function ProcessData($data, $image_url)
    {
        $response = $data["response"];
        $plant_net = $data["plant_net"];
        $probability = $data["probability"];

        foreach ($response as $key => $res) {
            foreach ($probability as $prob) {
                if ($res["peat_id"] == $prob["peat_id"]) {
                    $response[$key]["probability"] = $prob["probability"];
                }
                $plant = PlantPathogen::query()->where("peat_id", "=", $res["peat_id"])->first();
                if ($plant != null) {
                    $response[$key]["name_vi"] = $plant["name"];
                }
            }
            unset($response[$key]["reference_images"]);
            unset($response[$key]["eppo"]);
        }
        return ["plant_net" => $plant_net, "response" => $response, "image_url" => $image_url];
    }
}
