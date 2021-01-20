<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserOnline
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
        $expiresAt = Carbon::now()->addMinutes(1);
        if(Auth::check() && Auth::guard('admin')->check() && $request->is('admin/*')) {
            Cache::put('admin-is-online-' . Auth::user()->id, true, $expiresAt);
        }else if (Auth::check() && Auth::guard('web')->check()){
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
