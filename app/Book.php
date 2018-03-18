<?php

namespace App;
use App\Traits\IStatus;
use App\Traits\StatusTrait;

/**
 * @property int $id
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 * @property string $description
 * @property bool $status
 * @property int $start_node_id
 */
class Book extends BaseModel implements IStatus
{
    use StatusTrait;

    const STATUS_CREATED = 10;
    const STATUS_ACTIVE = 20;

    protected $table = "books";

    protected $fillable = ["title", "description", "start_node_id", "status"];

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

    public function nodes()
    {
        return $this->hasMany('App\Node');
    }

    public function nodeItems()
    {
        return $this->hasManyThrough('App\NodeItem', 'App\Node');
    }

    public static function getStatusLabels(): array
    {
        return [
            static::STATUS_CREATED => "Создано",
            static::STATUS_ACTIVE => "Активно",
        ];
    }
}
