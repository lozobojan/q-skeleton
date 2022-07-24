<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;

class AuthService
{

    // Define endpoint for auth token
    const API_TOKEN_URI = "/api/v2/token";

    /**
     * @param array $credentials
     * @return bool
     * @throws GuzzleException
     */
    public static function login(array $credentials): bool
    {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_TOKEN_URI);
        $remoteApiResponse = $remoteApiService->request('POST', $credentials);

        if ($remoteApiResponse){
            self::saveLoginData($remoteApiResponse);
            return true;
        }
        return false;
    }

    // TODO: save token and other details to redis
    /**
     * @param Object $data
     * @return void
     */
    public static function saveLoginData(Object $data): void{
        Session::put('bearerToken', $data->token_key);
        Session::put('refreshToken', $data->refresh_token_key);
        Session::put('tokenExpiresAt', $data->expires_at);
        Session::put('userDetails', $data->user);
    }

    /**
     * @return void
     */
    public static function logout(): void{
        Session::flush();
    }
}
