<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhoneExists
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
            $user = backpack_auth()->user();
            if ($user->phone != null || $user->phone != "" ) {
                return $next($request);
            } else {
                return redirect()->route('personal.edit')->with(['error' => 'يرجي استكمال بيانات الحساب حتي تتمتع بأفضل تجربة في الموقع']);
            }
        }

    }
}
