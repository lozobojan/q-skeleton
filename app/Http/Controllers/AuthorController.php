<?php

namespace App\Http\Controllers;

use App\Mappers\AuthorsMapper;
use App\Services\RemoteEntities\AuthorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $authorsData = AuthorService::fetchData($request);

        return view('authors.index', [
            'authors' => AuthorsMapper::stdObjectsToAuthors($authorsData->items),
            // pagination metadata
            'totalResults' => $authorsData->total_results,
            'displayedResults' => count($authorsData->items),
            'totalPages' => $authorsData->total_pages,
            'currentPage' => $authorsData->current_page,
            'paginationLimit' => $authorsData->limit,
            'routeName' => "authors.index"
        ]);
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return Factory|View|Application
     */
    public function show(Request $request, int $id = null): Factory|View|Application{
        $authorData = AuthorService::fetchData($request, $id);
        return view('authors.show', [
            'author' => $authorData
        ]);
    }
}
