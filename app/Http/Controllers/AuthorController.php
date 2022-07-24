<?php

namespace App\Http\Controllers;

use App\Services\RemoteEntities\AuthorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {
        return view('authors.index', [
            'authors' => AuthorService::fetchData()
        ]);
    }
}
