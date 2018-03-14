<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait SelectItems
{
    public static function getItems(string $valueAttribute, string $keyAttribute = "id")
    {
        $models = static::orderBy("created_at", "DESC")->get();

        return static::createItems($models, $valueAttribute, $keyAttribute);
    }

    public static function createItems($models, string $valueAttribute, string $keyAttribute = "id")
    {
        $items = [
            "" => "",
        ];

        foreach ($models as $model) {
            $items[$model->$keyAttribute] = $model->$valueAttribute !== null ? $model->$valueAttribute : sprintf("%s: %s", $keyAttribute, $model->$keyAttribute);
        }

        return $items;
    }
}