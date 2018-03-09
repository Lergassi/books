<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function homepage()
    {
        return view("site/homepage", []);
    }

    public function test()
    {
        return "test";
    }
}
