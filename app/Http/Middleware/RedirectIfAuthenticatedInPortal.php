<?php

namespace App\Http\Middleware;

use App\Support\Facades\PortalAuth;
use Closure;

class RedirectIfAuthenticatedInPortal
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
            return redirect()->route('portal-dashboard');
        }

        return $next($request);
    }
}
