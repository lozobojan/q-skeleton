<?php

namespace App\Mappers;

use App\Models\Author;

class AuthorsMapper
{
    public static function stdObjectToAuthor(Object $author): Author
    {
        return new Author(
            $author->first_name,
            $author->last_name,
            $author->birthday,
            $author->gender,
            $author->place_of_birth,
        );
    }

    public static function stdObjectsToAuthors(array $objects): array
    {
        return array_map(function($stdObject){
            return self::stdObjectToAuthor($stdObject);
        }, $objects);
    }
}
