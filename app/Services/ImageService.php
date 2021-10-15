<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 10/12/2021
 * Time: 9:01 AM
 */

namespace App\Services;


use App\Models\ChecksumImage;

class ImageService
{
    public static function CheckSHAImage($sha)
    {
        $result = ChecksumImage::query()->where('sha', $sha)->first();
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function SaveSHAImage($sha, $identify_user_id)
    {
        $checksum = new ChecksumImage();
        $checksum->identify_user_id = $identify_user_id;
        $checksum->sha = $sha;
        $checksum->save();
    }
}
