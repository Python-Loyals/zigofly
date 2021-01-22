<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateQuotationRequest;
use App\Quote;
use Illuminate\Http\Request;

class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::all()->sortByDesc('created_at');
        return view('admin.quotations.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        return view('admin.quotations.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminUpdateQuotationRequest  $request
     * @param  Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateQuotationRequest $request, Quote $quote)
    {
        $products = $request->input('products');
        $total = 0;
        foreach ($products as $id => $product) {
            $db_product = $quote->products()->find($id);
            $db_product->update($products[$id]);
            $total += floatval($product['price']) * (int) $db_product['quantity'];
        }

        if ($request->has('old_services')){
            $services = $request->input('old_services');

            $service_ids = array_keys($services);
            $quote->services()->whereNotIn('id', $service_ids)->delete();

            foreach ($quote->services as $service) {
                $total += floatval($service['price']);
            }
        }
        else{
            if (count($quote->services) > 0){
                $quote->services()->delete();
            }
        }


        if ($request->has('services')){
            $services = $request->input('services');

            $quote->services()->createMany($services);

            foreach ($services as $service) {
                $total += floatval($service['price']);
            }
        }

        $quote->update(['amount'=>$total, 'status' => 1]);
        $quote->load(['services', 'products']);

        return redirect()
            ->route('admin.estimates.index')
            ->with('message', 'Quote was processed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        return back();
    }
}
