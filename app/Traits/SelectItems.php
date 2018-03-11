<?php

namespace App\Traits;

trait SelectItems
{
    public static function getItems(string $valueAttribute, string $keyAttribute = "id")
    {
        $models = static::all();

        $items = [
            "" => "",
        ];

        foreach ($models as $model) {
            $items[$model->$keyAttribute] = $model->$valueAttribute !== null ? $model->$valueAttribute : sprintf("%s: %s", $keyAttribute, $model->$keyAttribute);
        }

        return $items;
    }
}