<?php namespace App\Http\Controllers\Portal;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

/**
 * This class handle portal dashboard
 *
 * @package App\Http\Controllers
 * @author efriandika
 */
class DashboardController extends Controller
{

	protected $auth;

	/**
	 * DashboardController constructor.
	 *
	 * @param $auth
	 */
	public function __construct(PortalGuard $auth) {
		$this->auth = $auth;
	}

	/**
	 * Show the dashboard.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showDashboard()
    {
		if($this->auth->isCompany())
			return $this->getCompanyDashboard();
		else
			return $this->getIndividualDashboard();
    }

	/**
	 * Get dashboard page for individual account type
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    private function getIndividualDashboard() {
	    $data = [
		    'pagetTitle'    => 'Portal Dashboard',
		    'user'          => $this->auth->user()
	    ];

	    return view('portal.dashboard.individual', $data);
    }

	/**
	 * Get dashboard page for company account type
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    private function getCompanyDashboard() {
        $lastDayEachMonth = [];
        for ($i = 1; $i <= 6; $i++) {
            $lastDayEachMonth[] = Carbon::createFromDate(date('Y'), date('m'), 1)
                ->subMonth($i-1)
                ->subDay(1);
        }

	    $data = [
		    'pagetTitle'    => 'Portal Dashboard',
		    'user'          => $this->auth->user(),
            'lastDayEachMonth' => $lastDayEachMonth
	    ];

	    return view('portal.dashboard.company', $data);
    }
}
