<?php

namespace App\Http\Middleware;

use App\Support\Facades\BranchAuth;
use Closure;

class RedirectIfAuthenticatedInBranch
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
        if (BranchAuth::check()) {
            return redirect()->route('branch-dashboard');
        }

        return $next($request);
    }
}
