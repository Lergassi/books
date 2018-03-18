<?php


namespace App;


class Html
{
    public static function select(string $name, $items, $value = null, array $params = [])
    {
        return view("html/select", [
            "items" => $items,
            "name" => $name,
            "value" => $value,
            "attr" => static::attrFormat($params),
        ]);
    }

    public static function input(string $name, $value = "", array $params = [])
    {
        return view("html/input", [
            "type" => "text",
            "name" => $name,
            "value" => $value,
            "attr" => static::attrFormat($params),
        ]);
    }

    public static function hidden(string $name, $value = "", array $params = [])
    {
        return view("html/input", [
            "type" => "hidden",
            "name" => $name,
            "value" => $value,
            "attr" => static::attrFormat($params),
        ]);
    }

    public static function attrFormat(array $attributes)
    {
        $attr = "";

        foreach ($attributes as $name => $value) {
            if (is_bool($value)) {
                if ($value === true)
                    $attr .= sprintf(" %s", $name);
            } else
                $attr .= sprintf(' %s = %s', $name, $value);
        }

        return $attr;
    }

    public static function checkbox(string $name, $value = "", array $params = [])
    {
        return view("html/input", [
            "type" => "checkbox",
            "name" => $name,
            "value" => $value,
            "attr" => static::attrFormat($params),
        ]);
    }
}