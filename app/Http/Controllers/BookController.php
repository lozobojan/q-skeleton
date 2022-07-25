<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Mappers\AuthorsMapper;
use App\Services\RemoteEntities\AuthorService;
use App\Services\RemoteEntities\BookService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function create(Request $request): Factory|View|Application
    {
        $authors = AuthorService::fetchData($request, null, true);
        return view('books.create', [
            'authors' => AuthorsMapper::stdObjectsToAuthors($authors->items)
        ]);
    }

    public function save(SaveBookRequest $request): RedirectResponse{
        dd($request->all());
        BookService::save();
        return redirect()->back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        BookService::delete($id);
        return redirect()->back();
    }
}
