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
        $authorsData = AuthorService::fetchData();

        // TODO: pagination
        return view('authors.index', [
            'authors' => AuthorsMapper::stdObjectsToAuthors($authorsData->items),
        ]);
    }
}
