<?php

namespace App\Http\Controllers;

use App\Mappers\AuthorsMapper;
use App\Services\RemoteEntities\AuthorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class AuthorController extends Controller
{
    private AuthorService $authorService;

    #[Pure]
    public function __construct()
    {
        $this->authorService = new AuthorService();
    }
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $authorsData = $this->authorService->fetchData($request);

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
     * @param int $id
     * @return Factory|View|Application
     */
    public function show(Request $request, int $id): Factory|View|Application{
        $authorData = $this->authorService->fetchData($request, $id);
        return view('authors.show', [
            'author' => AuthorsMapper::stdObjectToAuthor($authorData)
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->authorService->delete($id);
        return redirect()->route('authors.index');
    }
}
