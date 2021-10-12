<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/23/2021
 * Time: 9:26 AM
 */

namespace App\Services;


use App\Constants\PlantixConstant;
use App\Models\MstPathogen;
use App\Models\PlantPathogen;
use App\Utils\CommonUtil;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
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
    public static function ImageAnalysis(UploadedFile $image): array
    {
        $image->move(public_path() . "/", $image->getClientOriginalName());
        $image_url = public_path() . "/" . $image->getClientOriginalName();
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
        return PlantixServices::ProcessData(json_decode($raw_data, true), $image_url);
    }

    /**
     * Xử lý dữ liệu nhận được từ Plantix
     */
    public static function ProcessData($data, $image_url): array
    {
        $response = $data["image_analysis"];
        $plant_net = $data["plant_net"];

        foreach ($response as $key => $res) {

                $plant = MstPathogen::query()->where("peat_id", "=", $res["peat_id"])->first();
                if ($plant != null) {
                    $response[$key]["name_vi"] = $plant["name"];
                }
        }

        //Xóa bỏ public path để tạo thành public url cho ảnh
        $public_image = str_replace(public_path(), "", $image_url);
        return ["plant_net" => $plant_net, "response" => $response, "image_url" => $image_url, "public_image" => $public_image];
    }
}
