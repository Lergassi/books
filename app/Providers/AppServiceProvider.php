<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share("titleSite", "Books");
        View::share("asd", "Books");
        View::share("topMenu", [
//            [
//                "label" => "Главная",
//                "url" => route("homepage"),
//            ],
            [
                "label" => "Книги",
//                "url" => route("book.index"),
            ],
            [
                "label" => "Создать книгу",
//                "url" => route("book.create"),
            ],
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
