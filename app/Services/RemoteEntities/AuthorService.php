<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Support\Facades\Session;

class AuthorService
{
    const API_AUTHORS_URI = "/api/v2/authors";

    public static function fetchData(){

        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        $remoteApiResponse = $remoteApiService->request('GET', [], [
            "Authorization" => "Bearer ".Session::get('bearerToken')
        ]);


    }

}
