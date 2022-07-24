<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Support\Facades\Session;

class AuthorService
{
    const API_AUTHORS_URI = "/api/v2/authors";

    public static function fetchData() : ?Object
    {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        return $remoteApiService->authorize()->request('GET');
    }

}
