<?php namespace App\Http\Controllers\Portal;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;

/**
 * This class handle portal dashboard
 *
 * @package App\Http\Controllers
 * @author efriandika
 */
class DashboardController extends Controller
{

	/**
	 * Show the dashboard.
	 *
	 * @param PortalGuard $auth
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(PortalGuard $auth)
    {
    	$data = [
    		'user' => $auth->user()
	    ];

        return view('portal.dashboard.index', $data);
    }
}
