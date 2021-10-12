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
    public static function CheckSHAImage($file)
    {
        $sha = sha1_file($file);
        $result = ChecksumImage::query()->where('sha', $sha)->first();
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
