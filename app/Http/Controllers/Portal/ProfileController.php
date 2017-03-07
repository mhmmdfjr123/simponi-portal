<?php namespace App\Http\Controllers\Portal;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use Carbon\Carbon;
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
    	if($auth->user()->accountPerson->tglLahir) {
    		$age = Carbon::createFromTimestamp(strtotime($auth->user()->accountPerson->tglLahir))
			    ->diff(Carbon::now())->format('%y tahun, %m bulan and %d hari');
	    } else
		    $age = null;

    	$data = [
    		'pageTitle'  => 'Profile',
		    'user'       => $auth->user(),
		    'account'    => $auth->user()->accountPerson,
		    'age'        => $age
	    ];

        return view('portal.profile.showProfile', $data);
    }

    public function saveNewProfile(Request $request, PortalApiClientService $apiClient, PortalGuard $auth){
    	$this->validate($request, [
    		'username'  => 'required',
		    'email'     => 'required|email',
		    'mobilePhone'     => 'required',
	    ]);

    	$isUsernameChanged = $request->get('username') != $auth->user()->username;

    	try {
		    $rawResponse = $apiClient->post('api/perorangan/change', ['json' => [
			    'account'       => $auth->user()->accountPerson->accountNumber,
			    'changeUser'    => $isUsernameChanged,
			    'usernameOld'   => $auth->user()->username,
			    'usernameNew'   => $isUsernameChanged ? $request->get('username') : $auth->user()->username,
			    'changePassword'=> false,
			    'passwordOld'   => '',
			    'passwordNew'   => '',
			    'emailNew'      => $request->get('email'),
			    'mobilePhone'   => $request->get('mobilePhone'),
		    ]]);

		    if ($isUsernameChanged){
			    \Log::info('Change username from '.$auth->user()->username.' to '.$request->get('username'));
			    $auth->logout();
			    return redirect()->route('portal-login')->with('success', 'Username berhasil diganti. Silahkan login dengan menggunakan username anda yang baru');
		    }

		    // $response = json_decode($rawResponse->getBody());

		    return redirect()->route('portal-profile')->with('success', 'Profil berhasil diperbarui');
	    } catch (RequestException $e) {
		    if($e->hasResponse()) {
			    $response = json_decode($e->getResponse()->getBody());
			    $message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
		    } else {
			    $message = $e->getMessage();
		    }

		    return redirect()->route('portal-profile')->withErrors($message);
	    }
    }

	public function showChangePasswordForm(Request $request){
		if(!$request->ajax())
			return redirect()->route('portal-dashboard');

		return view('portal.profile.changePassword');
	}

	public function changePassword(Request $request, PortalApiClientService $apiClient, PortalGuard $auth){
		\Log::info($auth->user()->username.': try to change password');

		try {
			$rawResponse = $apiClient->post('api/perorangan/change', ['json' => [
				'account'       => $auth->user()->accountPerson->accountNumber,
				'changeUser'    => false,
				'usernameOld'   => $auth->user()->username,
				'usernameNew'   => $auth->user()->username,
				'changePassword'=> true,
				'passwordOld'   => $request->get('old-password'),
				'passwordNew'   => $request->get('password'),
				'emailNew'      => $auth->user()->email,
				'mobilePhone'   => $auth->user()->mobilePhone,
			]], true, false);

			// $response = json_decode($rawResponse->getBody());

			return response()->json([
				'status'    => 'ok',
				'message'   => 'Selamat..!! Password anda berhasil diganti.'
			]);
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return response()->json([
				'status'        => 'error',
				'message'       => $message
			]);
		}
	}
}
