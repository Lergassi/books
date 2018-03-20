<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function homepage()
    {
        $bookHomepageCount = config("app.booksHomepageCount", 10);
        $booksQuery = Book::where("status", Book::STATUS_ACTIVE)
            ->orderBy("created_at", "DESC")
            ->limit($bookHomepageCount);

        if(Auth::user() && Auth::user()->name == "admin") {
            $booksQuery->orWhere("status", Book::STATUS_CREATED);
        }

        $books = $booksQuery->get();

        return view("site/homepage", ["books" => $books]);
    }

    public function test()
    {
        return "test";
    }
}
