<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthorService
{
    const API_AUTHORS_URI = "/api/v2/authors";

    /**
     * Try to find the cache hit ot fetch data from API and save to cache
     * @return Object|null
     */
    public static function fetchData(Request $request) : ?Object
    {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        if($request->has('page')){
            $remoteApiService->appendUri("?page={$request->get('page')}");
        }

        // try to get cache hit
        $endpointCacheKey = md5($remoteApiService->getUrl());
        if(Cache::has($endpointCacheKey))
            return json_decode(Cache::get($endpointCacheKey));

        // if cache is not hit, fetch the data
        $remoteApiResponse = $remoteApiService->authorize()->request('GET');
        Cache::put($endpointCacheKey, json_encode($remoteApiResponse), config('cache.ttl'));

        return $remoteApiResponse;
    }

}
