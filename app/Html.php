<?php


namespace App;


class Html
{
    public static function select(string $name, array $items, $value = null, array $params = [])
    {
        return view("html/select", [
            "items" => $items,
            "name" => $name,
            "value" => $value,
            "class" => isset($params["class"]) ? $params["class"] : "",
        ]);
    }

    public static function input(string $name, $value = "", array $params = [])
    {
//        __d($value);

        return view("html/input", [
            "name" => $name,
            "value" => $value,
            "class" => isset($params["class"]) ? $params["class"] : "",
        ]);
    }
}