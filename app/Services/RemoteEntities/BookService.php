<?php

namespace App\Services\RemoteEntities;

use App\Services\RemoteApiService;
use Illuminate\Support\Facades\Cache;

class BookService
{
    const API_BOOKS_URI = "/api/v2/books";

    /**
     * Delete a book with ID
     * @param int $id
     * @return void
     */
    public static function delete(int $id) : void {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_BOOKS_URI."/".$id);
        $remoteApiService->authorize()->request('DELETE');
        Cache::tags('apiData')->flush();
    }

    /**
     * Save book data to remote API
     * @param array $bookData
     * @return void
     */
    public static function save(array $bookData) : void {
        $remoteApiService = app(RemoteApiService::class)->appendUri(self::API_BOOKS_URI);
        $remoteApiService->authorize()->request('POST', $bookData);
        Cache::tags('apiData')->flush();
    }
}
