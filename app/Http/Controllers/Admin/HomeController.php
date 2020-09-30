<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        return view('home');
    }
    public function shop()
    {
        return view('shop');
    }
}
