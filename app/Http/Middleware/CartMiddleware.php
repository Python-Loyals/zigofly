<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()){
            Cart::restore(Auth::user()->id);
            if(Cart::count() > 0)
            {

                foreach ( Cart::content()  as $row )
                {
                    if ( ! $row->model )
                    {
                        Cart::restore(Auth::id());
                        Cart::remove( $row->rowId );
                        Cart::store(Auth::id());
                    }

                }

            }
        }
        return $next($request);
    }
}
