<?php

namespace App\Providers;

use App\Read;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
        View::share("titleSite", config("app.name"));

        //Создание модели Read для всех методов контроллера.
        Route::bind('read', function ($value) {
            $read = Read::loadRead($value);

            return $read;
        });
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
