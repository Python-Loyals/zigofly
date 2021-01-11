<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()->id == 1){
            return view('admin.home.index');
        }else{
            $orders = Order::all();
            $quotes = Quote::all();
            return view('admin.home.index2', compact('orders', 'quotes'));
        }
    }
}
