<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 * @property string $description
 */
class Book extends Model
{
    protected $table = "books";

    protected $fillable = ["title", "description"];

    /**
     * @return Book
     */
    public static function createSample()
    {
        $book = new Book();
        $book->title = "Sample book";
        $book->description = "Description";

        return $book;
    }
}
