<?php

namespace App;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $text
 * @property int $book_id
 * @property int $next_node_id
 */
class Node extends BaseModel
{
    protected $table = "nodes";
    protected $fillable = ["title", "text", "book_id"];

    public function items()
    {
        return $this->hasMany('App\NodeItem');
    }

    public function book()
    {
        return $this->belongsTo("App\Book");
    }
}
