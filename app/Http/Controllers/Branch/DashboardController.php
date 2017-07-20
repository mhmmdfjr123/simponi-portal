<?php namespace App\Http\Controllers\Branch;

use App\Contracts\BranchGuard;
use App\Http\Controllers\Controller;

/**
 * This class handle branch dashboard
 *
 * @package App\Http\Controllers\Branch
 * @author efriandika
 */
class DashboardController extends Controller
{

	protected $auth;

	/**
	 * DashboardController constructor.
	 *
	 * @param BranchGuard $auth
	 */
	public function __construct(BranchGuard $auth) {
		$this->auth = $auth;
	}


	/**
	 * Show the dashboard.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showDashboard()
    {
		// Check the account's role
	    if($this->auth->isSuperAdmin()) {
			return redirect()->route('branch-search-account');
	    } else {
		    return redirect()->route('branch-search-portal-account');
	    }

    }
}
