<?php

namespace App;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $node_id
 * @property int $next_node_id
 * @property string $text
 */
class NodeItem extends BaseModel
{
    protected $table = "node_items";
    protected $fillable = ["text", "node_id"];

    public function node()
    {
        return $this->hasOne("App\Node", "id", "node_id");
    }
}
