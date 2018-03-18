<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$middleware = [];
$middleware["middleware"] = ["web"];

if (Config::get('app.debug')) {
    $middleware["middleware"][] = "clearcache";
}

Route::group($middleware, function () {
    Route::get("/", "SiteController@homepage")->name("homepage");
    Route::get("/test", "SiteController@test");

//    Route::get("/admin", "admin\\SiteController@homepage");
    Route::resource("book", "BookController");
    Route::resource("node", "NodeController");
    Route::resource("node_item", "NodeItemController");

    Route::get("/read/{read}", "ReadController@read")->name("read");
    Route::get("/read/{read}/choice/{nodeItem}", "ReadController@choice")->name("read.choice");
    Route::get("/read/{read}/info", "ReadController@info")->name("read.info");
    Route::get("/read/{read}/reset", "ReadController@reset")->name("read.reset");
});

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');