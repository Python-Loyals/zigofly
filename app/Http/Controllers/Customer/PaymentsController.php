<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $quotePayments = $user->userQuotes
            ->load('payment')
            ->pluck(['payment']);
        $orderPayments = $user->userOrders
            ->load('payment')
            ->pluck('payment');

        $payments = $orderPayments
            ->merge($quotePayments)
            ->filter()
            ->sortByDesc('created_at');

        return view('customer.payments.index', compact('payments'));
    }
}
