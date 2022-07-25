<?php

namespace App\Mappers;

use App\Http\Requests\SaveBookRequest;
use App\Models\Book;
use JetBrains\PhpStorm\ArrayShape;

class BooksMapper
{
    /**
     * map single STDObject to Book
     * @param Object $book
     * @return Book
     */
    public static function stdObjectToBook(Object $book): Book
    {
        return new Book(
            $book->id,
            $book->title,
            $book->description,
            $book->release_date,
            $book->isbn,
            $book->format,
            $book->number_of_pages,
        );
    }

    /**
     * map array of STDObjects to array of Books
     * @param array $objects
     * @return array
     */
    public static function stdObjectsToBooks(array $objects): array
    {
        return array_map(function($stdObject){
            return self::stdObjectToBook($stdObject);
        }, $objects);
    }

    /**
     * Map SaveBookRequest data into the array suitable for HTTP save request
     * @param SaveBookRequest $request
     * @return array
     */
    #[ArrayShape(["author" => "array", "title" => "mixed", "release_date" => "mixed", "description" => "mixed", "isbn" => "mixed", "format" => "mixed", "number_of_pages" => "mixed"])]
    public static function requestToApiData(SaveBookRequest $request): array{
        return [
            "author" => [
                "id" => (int)$request->get('authorId')
            ],
            "title" => $request->get('title'),
            "release_date" => $request->get('releaseDate'),
            "description" => $request->get('description'),
            "isbn" => $request->get('isbn'),
            "format" => $request->get('format'),
            "number_of_pages" => (int)$request->get('numberOfPages'),
        ];
    }
}
