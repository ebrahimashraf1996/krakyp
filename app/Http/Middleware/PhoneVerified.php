<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhoneVerified
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
            if ($user->is_verified == true) {
                return $next($request);
            } else {
                return redirect()->route('verifying.view')->with(['error' => 'يرجي تفعيل الحساب حتي تتمكن من نشر الإعلانات']);
            }
        }

    }
}
