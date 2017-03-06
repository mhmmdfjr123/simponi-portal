<?php

namespace App\Http\Middleware;

use App\Services\PortalSessionGuardService;
use App\Support\Facades\PortalAuth;
use Closure;
use Illuminate\Support\Facades\Session;

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
        if (PortalAuth::check()) {
            return $next($request);
        }

        return redirect()->route('portal-login')->withErrors(Session::get(PortalSessionGuardService::class));
    }
}
