<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsInfoComplete
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (backpack_auth()->check()) {
            $user = backpack_auth()->user();
            if ($user->phone == null || $user->whats_app == null) {
                return redirect()->to(url('personal-edit'))->with(['error' => 'برجاء إكمال بيانات التواصل حتي تتمكن من نشر الإعلان']);
            } else {
                return $next($request);
            }
        } else {
            return redirect()->to(url('login'))->with(['error-auth' => __('messages.auth-warning')]);
        }

    }
}
