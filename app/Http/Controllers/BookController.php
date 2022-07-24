<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create(): Factory|View|Application
    {
        // TODO: fetch authors and return for a drop-down menu
        return view('books.create', [

        ]);
    }
}
