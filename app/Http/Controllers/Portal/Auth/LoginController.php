<?php namespace App\Http\Controllers\Portal\Auth;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Portal\PortalBaseController;
use App\Services\ApiClient\PortalApiClientService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * Handle login for portal
 *
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class LoginController extends PortalBaseController {

	/**
	 * Create a new controller instance.
	 *
	 * @param Request $request
	 */
    public function __construct(Request $request) {
        $this->middleware('guest.portal', ['except' => 'logout']);
    }

    public function showLoginForm() {
    	$data = [
    	    'pageTitle' => 'Login'
	    ];

        return view('portal.auth.login', $data);
    }

    public function login(Request $request, PortalGuard $auth) {
        $this->validateLogin($request);

	    $credentials = [
            'username'      => $request->get('username'),
            'password'      => $request->get('password')
        ];

        $response = $auth->login($credentials);

        if($response['status'])
        	return redirect()->route('portal-dashboard');
        else
        	return redirect()->back()->withInput(['username'])->withErrors($response['message']);
    }

    public function showRegistrationForm() {
        $data = [
		    'pageTitle' => 'Pendaftaran'
	    ];

        return view('portal.auth.register', $data);
    }

    public function register(Request $request, PortalApiClientService $apiClient) {
        $this->validate($request, [
            'account' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'noId' => 'required',
            'birthdate' => 'required',
            'mobilePhoneNo' => 'required'
        ]);

        $data = [
            'account'       => $request->get('account'),
            'username'      => $request->get('username'),
            'password'      => $request->get('password'),
            'email'         => $request->get('email'),
            'noId'          => $request->get('noId'),
            'birthdate'     => date('Y-m-d', strtotime($request->get('birthdate'))),
            'mobilePhoneNo' => $request->get('mobilePhoneNo'),
        ];

        try {
        	$apiClient->post('admin/perorangan/register', ['json' => $data], false);

	        return view('portal.auth.registerConfirmation', [
		        'pageTitle' => 'Pendaftaran Berhasil'
	        ]);
        } catch (RequestException $e) {
	        if($e->hasResponse()) {
		        $response = json_decode($e->getResponse()->getBody());
		        $message = (isset($response->message)) ? $response->message : 'An error occurred, please call the administrator.';
	        } else {
		        $message = $e->getMessage();
	        }

	        return redirect()->route('portal-register')
		        ->withInput($request->except('password'))
		        ->withErrors($message);
        }
    }

    public function logout(PortalGuard $auth) {
    	$auth->logout();
        return redirect()->route('portal-login')->with('success', 'Logout berhasil.');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function validateLogin(Request $request) {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);
    }
}
