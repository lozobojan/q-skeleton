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
     * @param Request $request
     * @param int|null $id
     * @param bool $fetchAll
     * @return Object|null
     */
    public function fetchData(Request $request, int $id = null, bool $fetchAll = false) : ?Object
    {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        $this->prepareRemoteApiService($remoteApiService, $request, $fetchAll, $id);

        // try to get cache hit
        $endpointCacheKey = md5($remoteApiService->getUrl());
        if(Cache::tags('apiData')->has($endpointCacheKey))
            return json_decode(Cache::tags('apiData')->get($endpointCacheKey));

        // if cache is not hit, fetch the data
        $remoteApiResponse = $remoteApiService->authorize()->request('GET');
        Cache::tags('apiData')->put($endpointCacheKey, json_encode($remoteApiResponse), config('cache.ttl'));

        return $remoteApiResponse;
    }

    /**
     * Save author data to remote API
     * @param array $authorData
     * @return void
     */
    public function save(array $authorData) : void {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI);
        $remoteApiService->authorize()->request('POST', $authorData);
        Cache::tags('apiData')->flush();
    }

    /**
     * Delete an author with ID
     * @param int $id
     * @return void
     */
    public function delete(int $id) : void {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_AUTHORS_URI."/".$id);
        $remoteApiService->authorize()->request('DELETE');
        Cache::tags('apiData')->flush();
    }

    /**
     * @param RemoteApiService $remoteApiService
     * @param Request $request
     * @param bool $fetchAll
     * @param int|null $id
     * @return void
     */
    private function prepareRemoteApiService(RemoteApiService &$remoteApiService, Request $request, bool $fetchAll = false, int $id = null): void{
        // if fetching single user details
        if(!is_null($id))
            $remoteApiService->appendUri("/$id");

        $remoteApiService->appendRequestParams($request, $fetchAll);
    }
}
