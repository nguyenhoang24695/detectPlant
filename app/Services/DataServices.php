<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 10/11/2021
 * Time: 5:32 PM
 */

namespace App\Services;


use App\Models\IdentifyUser;
use Illuminate\Support\Facades\Session;

class DataServices
{
    public static function CreateUserIdentifyTest($plantix_data)
    {
        $user = Session::get('user');
        // Tạo identiuser ảo
        $identifu_user = new IdentifyUser();
        $identifu_user->user_id = $user->id;
        $identifu_user->latitude = 120;
        $identifu_user->longitude = 120;
        $identifu_user->pathogen_indentify_status = 1;
        $identifu_user->image = $plantix_data["image_url"];
        $identifu_user->air_temperature = 35;

        $identifu_user->save();

    }
}
