<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.orders.index');
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
        if (Cart::count() > 0){
            $cartItems = Cart::content();
            $orderDetails = [
                'sub_total' => Cart::subtotal(),
                'total'     => Cart::total(),
                'user_id'   => Auth::user()->id
            ];

            $order = Order::create($orderDetails);

            $items = [];
            foreach ($cartItems as $cartItem) {
                $items[]= [
                    'product_id' => $cartItem->id,
                    'order_id'  => $order->id,
                    'quantity'  => (int) $cartItem->qty,
                    'color'     => $cartItem->options->color ?? '',
                    'size'     => $cartItem->options->size ?? '',
                    'other_options'     => $cartItem->options->other_options ?? '',
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ];
            }

            OrderItem::insert($items);

            Cart::destroy(Auth::user()->id);
            Cart::store(Auth::user()->id);

            return back()->with(['success', 'checked out']);
        }

        return back()->withErrors(['message'=>'Your cart is empty']);
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
    public function destroy($id)
    {
        //
    }
}
