<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class Author extends Model
{
    use HasFactory;

    public int $id;
    public string $firstName;
    public string $lastName;
    public string $birthday;
    public string $gender;
    public string $placeOfBirth;
    public array $books = [];

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $birthday
     * @param string $gender
     * @param string $placeOfBirth
     * @param array $books
     */
    public function __construct(int $id, string $firstName, string $lastName, string $birthday, string $gender, string $placeOfBirth, array $books = [])
    {
        parent::__construct();
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = Carbon::parse($birthday)->format('d.m.Y');
        $this->gender = $gender;
        $this->placeOfBirth = $placeOfBirth;
        $this->books = $books;
    }

    public function getFullNameAttribute(): string
    {
        return $this->firstName." ".$this->lastName;
    }

    #[Pure]
    public function getGenderAbbrAttribute():string {
        return Str::upper($this->gender[0]);
    }
}
