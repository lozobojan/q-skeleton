<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Support\Facades\Cache;

class BookService
{
    const API_AUTHORS_URI = "/api/v2/books";

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
