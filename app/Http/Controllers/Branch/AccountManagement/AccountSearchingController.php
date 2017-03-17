<?php namespace App\Http\Controllers\Branch\AccountManagement;

use App\Contracts\BranchGuard;
use App\Http\Controllers\Controller;
use App\Models\User;

/**
 * @author efriandika
 */
class AccountSearchingController extends Controller
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
	 * Show searching form to find portal account (individual / company)
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
    public function showPortalAccountForm()
    {
    	if($this->auth->isSuperAdmin()) {
    		return redirect()->route('branch-dashboard');
	    }

	    $data = [
		    'pageTitle' => 'Branch Portal',
		    'user'      => $this->auth->user()
	    ];

	    return view('branch.accountManagement.accountSearching.portalAccount', $data);
    }

	/**
	 * Show searching form to find branch account
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
    public function showBranchAccountForm()
    {
	    if(!$this->auth->isSuperAdmin()) {
		    return redirect()->route('branch-dashboard');
	    }

	    $data = [
		    'pageTitle' => 'Branch Portal',
		    'user'      => $this->auth->user()
	    ];

	    return view('branch.accountManagement.accountSearching.branchAccount', $data);
    }
}
