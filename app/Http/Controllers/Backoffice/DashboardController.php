<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Analytics\Users;
use App\Models\Analytics\UsersSession;
use Carbon\Carbon;

class DashboardController extends Controller {

    public function __construct(){

    }

    public function index(){
        $data = [
            'pageTitle' => 'Dashboard'
        ];

        return view('backoffice.dashboard.index', $data);
    }

    public function getCounterAnalytics(Users $userAnalytics, UsersSession $userSessionAnalytics) {
		$data = [
			'individualAccountTotal'  => $userAnalytics->getIndividualAccountTotal(),
			'companyAccountTotal'  => $userAnalytics->getCompanyAccountTotal(),
			'todayLogin'           => $userSessionAnalytics->getTotalLoginOnToday()
		];

		return response()->json($data);
    }

	public function getGraphAnalytics(UsersSession $userSessionAnalytics) {
        return response()->json([
            'data' => $userSessionAnalytics->getRegistrationHistory((new Carbon('-10days'))->format('Y-m-d'), Carbon::now()->format('Y-m-d'))
        ]);
	}
}