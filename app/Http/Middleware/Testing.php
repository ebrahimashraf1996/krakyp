<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Testing
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
        if(backpack_auth()->check()) {
            if(backpack_auth()->user()->id == 2) {
                return $next($request);

                //  return \Request::route()->getName();
                // return redirect(backpack_url('order'));
            } else {
                 return redirect(backpack_url('dashboard'));
            }
        } else {
            return redirect(backpack_url('login'));
        }
    }
}
