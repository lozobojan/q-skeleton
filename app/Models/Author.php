<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;

    public string $firstName;
    public string $lastName;
    public string $birthday;
    public string $gender;
    public string $placeOfBirth;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $birthday
     * @param string $gender
     * @param string $placeOfBirth
     */
    public function __construct(string $firstName, string $lastName, string $birthday, string $gender, string $placeOfBirth)
    {
        parent::__construct();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = Carbon::parse($birthday)->format('d.m.Y');
        $this->gender = Str::upper($gender[0]);
        $this->placeOfBirth = $placeOfBirth;
    }
}
