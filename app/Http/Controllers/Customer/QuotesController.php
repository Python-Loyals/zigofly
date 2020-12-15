<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreQuoteRequest;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return view('customer.quotes.index');
    }

    public function store(StoreQuoteRequest $request)
    {
        $request['customer_id'] = Auth::user()->id;
        if ($request->input('buy_ship')){
            $request['service'] = 2;
        }else if ($request->input('buy')){
            $request['service'] = 2;
        }

        $quote = Quote::create($request->except(['products', 'attachments']));

        $quote->addMultipleMediaFromRequest(['attachments'])->each(function ($fileReader){
            $fileReader->toMediaCollection('attachment');
        });

        return redirect()->route('customer.users.quotes');
    }
}
