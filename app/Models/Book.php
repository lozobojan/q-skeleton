<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public int $id;
    public string $title;
    public string $description;
    public string $releaseDate;
    public string $isbn;
    public string $format;
    public int $numberOfPages;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $releaseDate
     * @param string $isbn
     * @param string $format
     * @param int $numberOfPages
     */
    public function __construct(int $id, string $title, string $description, string $releaseDate, string $isbn, string $format, int $numberOfPages)
    {
        parent::__construct();
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->releaseDate = Carbon::parse($releaseDate)->format('d.m.Y');
        $this->isbn = $isbn;
        $this->format = $format;
        $this->numberOfPages = $numberOfPages;
    }

    public function getDescriptionTrimAttribute(): string
    {
        return strlen($this->description) > 25
            ? substr($this->description, 0, 25)."..."
            : $this->description;
    }

}
