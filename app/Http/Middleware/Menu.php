<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class Menu
{
    public function handle($request, Closure $next)
    {
        //TODO: перенести меню в настройки.
        $items = [
            [
                "label" => "Главная",
                "url" => route("homepage"),
            ],
            [
                "label" => "Книги",
                "url" => route("book.index"),

            ],
            [
                "label" => "Создать книгу",
                "url" => route("book.create"),
            ],
            [
                "label" => "Узлы",
                "url" => route("node.index"),
            ],
//            [
//                "label" => "Создать узел",
//                "url" => route("node.create"),
//            ],
            //TODO: временно
            [
                "label" => "Ответы",
                "url" => route("nodeItem.index"),
            ],
//            [
//                "label" => "Создать ответ",
//                "url" => route("nodeItem.create"),
//            ],
        ];

        foreach ($items as &$item) {
            if ($item["url"] == url()->current()) {
                $item["isCurrent"] = true;
                $item["class"] = "btn btn_link active";
            } else {
                $item["class"] = "btn btn_link";
            }
        }

        View::share("menu" , $items);

        return $next($request);
    }
}
