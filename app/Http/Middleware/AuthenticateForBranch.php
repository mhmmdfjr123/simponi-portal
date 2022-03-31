<?php

namespace App\Http\Middleware;

use App\Services\BranchSessionGuardService;
use App\Support\Facades\BranchAuth;
use Closure;
use Illuminate\Support\Facades\Session;

class AuthenticateForBranch
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
            return $next($request);
        }

        if ($request->ajax())
        	return abort(401, 'Unauthorized');

        return redirect()->route('branch-login')->withErrors(Session::get(BranchSessionGuardService::class));
    }
}
