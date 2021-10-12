<?php
/**
 * Created by WeatherPlus.
 * User: hoangnv
 * Date: 10/11/2021
 * Time: 5:00 PM
 */

namespace App\Services;


use App\Models\User;

class UserService
{
    public static function TestUser()
    {
        return User::query()->first();
    }
}
