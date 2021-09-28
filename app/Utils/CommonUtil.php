<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 9/23/2021
 * Time: 9:13 AM
 */

namespace App\Utils;


class CommonUtil
{
    public static function GenerateGuid()
    {

        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
