<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function homepage()
    {
        return view("admin/site/homepage", [
            "title" => "Admin"
        ]);
    }
}
