<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

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

    /**
     * @param Object $data
     * @return void
     */
    public static function saveLoginData(Object $data): void{

        $ttl = config('cache.auth_data_ttl', 86400);

        Cache::tags('auth')->put('bearerToken', $data->token_key, $ttl);
        Cache::tags('auth')->put('refreshToken', $data->refresh_token_key, $ttl);
        Cache::tags('auth')->put('tokenExpiresAt', $data->expires_at, $ttl);
        Cache::tags('auth')->put('userDetails', $data->user, $ttl);
    }

    /**
     * @return void
     */
    public static function logout(): void{
        Cache::tags('auth')->flush();
    }
}
