<?php

namespace App\Http\Controllers\Customer;

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
