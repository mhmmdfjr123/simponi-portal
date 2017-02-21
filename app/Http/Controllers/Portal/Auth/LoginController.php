<?php namespace App\Http\Controllers\Portal\Auth;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Portal\PortalBaseController;
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

    public function register(Request $request) {
        $this->validate($request, [
            'accountNumber' => 'required', 'username' => 'required', 'password' => 'required', 'email' => 'required'
        ]);

        $data = [
            'accountNumber' => $request->get('accountNumber'),
            'username'      => $request->get('username'),
            'password'      => $request->get('password'),
            'email'         => $request->get('email'),
        ];
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
