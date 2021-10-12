<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 10/11/2021
 * Time: 3:39 PM
 */

namespace App\Utils;


use App\Models\ChecksumImage;

class FileUtil
{
    public static function SaveImageToPublicFolder($image)
    {
        $image->move(public_path() . "/", $image->getClientOriginalName());
        $image_url = public_path() . "/" . $image->getClientOriginalName();
        return [$image_url, "/" . $image->getClientOriginalName()];
    }

    public static function SHAFile($file)
    {
        return sha1_file($file);
    }
}
