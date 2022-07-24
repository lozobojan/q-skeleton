<?php

namespace App\Mappers;

use App\Models\Book;

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
}
