<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthorService
{
    const API_AUTHORS_URI = "/api/v2/authors";

    // TODO: consider refactoring into multiple methods
    /**
     * Try to find the cache hit ot fetch data from API and save to cache
     * @param Request $request
     * @param int|null $id
     * @return Object|null
     */
    public static function fetchData(Request $request, int $id = null, bool $fetchAll = false) : ?Object
    {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);

        // if fetching single user details
        if(!is_null($id))
            $remoteApiService->appendUri("/$id");

        // try to get cache hit
        self::appendRequestParams($request, $fetchAll, $remoteApiService);
        $endpointCacheKey = md5($remoteApiService->getUrl());

        if(Cache::has($endpointCacheKey))
            return json_decode(Cache::get($endpointCacheKey));

        // if cache is not hit, fetch the data
        $remoteApiResponse = $remoteApiService->authorize()->request('GET');
        Cache::put($endpointCacheKey, json_encode($remoteApiResponse), config('cache.ttl'));

        return $remoteApiResponse;
    }

    /**
     * @param Request $request
     * @param bool $fetchAll
     */
    private static function appendRequestParams(Request $request, bool $fetchAll, RemoteApiService &$remoteApiService): void
    {
        $data = [];
        if($request->has('page'))
            $data['page'] = $request->get('page');
        if($fetchAll)
            $data['limit'] = PHP_INT_MAX;

        $remoteApiService->appendUri("?".http_build_query($data));
    }

    /**
     * Save author data to remote API
     * @param array $authorData
     * @return void
     */
    public static function save(array $authorData) : void {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        $remoteApiService->authorize()->request('POST', $authorData);
        Cache::flush();
    }

    /**
     * Delete an author with ID
     * @param int $id
     * @return void
     */
    public static function delete(int $id) : void {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI."/".$id);
        $remoteApiService->authorize()->request('DELETE');
        Cache::flush();
    }
}
