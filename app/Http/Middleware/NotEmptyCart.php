<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotEmptyCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!backpack_auth()->check()) {
            return redirect()->to(url('login'))->with(['error' => __('messages.auth-warning')]);
        } else {
            $count = \App\Models\Cart::where('order_id', null)->where('user_id', backpack_auth()->user()->id)->count();
            if ($count > 0) {
                return $next($request);
            } else {
                return redirect()->route('site.home')->with(['error' => 'يرجي إضافة بعض الباقات ']);
            }
        }

    }
}
