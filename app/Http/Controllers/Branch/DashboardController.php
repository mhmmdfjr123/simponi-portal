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

	/**
	 * Show the dashboard.
	 *
	 * @param BranchGuard $auth
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showDashboard(BranchGuard $auth)
    {
    	$data = [
		    'pageTitle' => 'Branch Portal',
		    'user'      => $auth->user()
	    ];

        return view('branch.dashboard.showDashboard', $data);
    }
}
