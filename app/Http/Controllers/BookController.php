<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Mappers\AuthorsMapper;
use App\Mappers\BooksMapper;
use App\Services\RemoteEntities\AuthorService;
use App\Services\RemoteEntities\BookService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class BookController extends Controller
{
    private BookService $bookService;
    private AuthorService $authorService;

    #[Pure]
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function create(Request $request): Factory|View|Application
    {
        $authors = $this->authorService->fetchData($request, null, true);
        return view('books.create', [
            'authors' => AuthorsMapper::stdObjectsToAuthors($authors->items)
        ]);
    }

    /**
     * @param SaveBookRequest $request
     * @return RedirectResponse
     */
    public function save(SaveBookRequest $request): RedirectResponse{
        $this->bookService->save(BooksMapper::requestToApiData($request));
        return redirect()->route("authors.show", ['id' => $request->get('authorId')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->bookService->delete($id);
        return redirect()->back();
    }
}
