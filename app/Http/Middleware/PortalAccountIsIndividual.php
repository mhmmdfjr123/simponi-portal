<?php

namespace App\Http\Middleware;

use App\Support\Facades\PortalAuth;
use Closure;

class PortalAccountIsIndividual
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 *
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
        if (PortalAuth::isIndividual()) {
            return $next($request);
        } else {
        	abort(403);
        }
    }
}
