<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreQuoteRequest;
use App\Quote;
use App\QuoteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $quotes = Auth::user()->userQuotes;
        return view('customer.quotes.index', compact('quotes'));
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

        $products = $request->get('products');

        foreach ($products as $product) {
            $product['quote_id'] = $quote->id;
            QuoteProduct::create($product);
        }

        if ($request->has('attachments')){
            $quote->addMultipleMediaFromRequest(['attachments'])->each(function ($fileReader){
                $fileReader->toMediaCollection('attachment');
            });
        }

        return redirect()->back();
    }
}
