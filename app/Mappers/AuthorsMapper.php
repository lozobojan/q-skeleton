<?php

namespace App\Mappers;

use App\Models\Author;

class AuthorsMapper
{
    /**
     * map single STDObject to Author
     * @param Object $author
     * @return Author
     */
    public static function stdObjectToAuthor(Object $author): Author
    {
        return new Author(
            $author->id,
            $author->first_name,
            $author->last_name,
            $author->birthday,
            $author->gender,
            $author->place_of_birth,
            isset($author->books) ? BooksMapper::stdObjectsToBooks($author->books) : []
        );
    }

    /**
     * map array of STDObjects to array of Authors
     * @param array $objects
     * @return array
     */
    public static function stdObjectsToAuthors(array $objects): array
    {
        return array_map(function($stdObject){
            return self::stdObjectToAuthor($stdObject);
        }, $objects);
    }
}
