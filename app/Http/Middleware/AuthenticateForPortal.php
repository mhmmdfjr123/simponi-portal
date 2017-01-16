<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateForPortal
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
        if (\Session::get('portal_session')['jwt_token'] != '') {
            return $next($request);
        }

        return redirect()->route('portal-login');
    }
}
