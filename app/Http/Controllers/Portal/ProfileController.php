<?php namespace App\Http\Controllers\Portal;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * @author efriandika
 */
class ProfileController extends Controller
{

	/**
	 * Show profile page.
	 *
	 * @param PortalGuard $auth
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showProfile(PortalGuard $auth)
    {
    	$data = [
    		'pageTitle'         => 'Profile',
		    'account'           => $auth->user()->accountPerson
	    ];

        return view('portal.profile.showProfile', $data);
    }

    public function saveNewProfile(Request $request){
    	$this->validate($request, [
    		'dateStart' => 'required|date_format:"d-m-Y"',
		    'dateEnd'   => 'required|date_format:"d-m-Y"',
	    ]);


    }
}
