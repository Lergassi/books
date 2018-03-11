<?php

namespace App;

/**
 * @property int $id
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 * @property string $description
 * @property bool $status
 */
class Book extends BaseModel
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
