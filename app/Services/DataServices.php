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
    public static function CreateUserIdentifyTest(string $image_public_url): IdentifyUser
    {
        $user = Session::get('user');
        // Tạo identiuser ảo
        $identifyUser = new IdentifyUser();
        $identifyUser->user_id = $user->id;
        $identifyUser->latitude = 120;
        $identifyUser->longitude = 120;
        $identifyUser->pathogen_indentify_status = 1;
        $identifyUser->image = $image_public_url;
        $identifyUser->air_temperature = 35;

        $identifyUser->save();
        return $identifyUser;

    }

    public static function ProcessIdentifyData($plantix_data,$planId_data){

    }
}
