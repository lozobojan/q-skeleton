<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Support\Facades\Cache;

class AuthorService
{
    const API_AUTHORS_URI = "/api/v2/authors";

    /**
     * Try to find the cache hit ot fetch data from API and save to cache
     * @return Object|null
     */
    public static function fetchData() : ?Object
    {
        if(Cache::has('authorsData'))
            return json_decode(Cache::get('authorsData'));

        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        $remoteApiResponse = $remoteApiService->authorize()->request('GET');

        Cache::put('authorsData', json_encode($remoteApiResponse), config('cache.ttl'));
        return $remoteApiResponse;
    }

}
