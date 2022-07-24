<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class AuthService
{
    public static function saveLoginData(Object $data): void{
        Session::put('bearerToken', $data->token_key);
        Session::put('refreshToken', $data->refresh_token_key);
        Session::put('userDetails', $data->user);
    }
}
