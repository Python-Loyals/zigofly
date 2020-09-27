<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCartQuantityRequest;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            Cart::restore(Auth::user()->id);
            return $next($request);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpdateCartQuantityRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateQuantity(UpdateCartQuantityRequest $request)
    {
        Cart::update($request->get('rowId'), $request->get('quantity'));
        Cart::store(Auth::user()->id);

        if ($request->expectsJson()){
            return response()->json([
                'message'=>'Product quantity was updated',
                'cart' => Cart::content(),
                'count' => Cart::count()]);
        }

        return redirect()->back()->with('Product quantity was updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        try {
            Cart::remove($rowId);
            Cart::store(Auth::user()->id);
            return redirect()->back()->with('Product deleted from cart');
        }
        catch (InvalidRowIDException $invalidRowIDException){
            return redirect()->back()->withErrors('The specified product was not found');
        }


    }
}
