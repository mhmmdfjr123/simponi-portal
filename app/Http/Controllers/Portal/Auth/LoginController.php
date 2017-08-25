<?php namespace App\Http\Controllers\Portal\Auth;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use App\Services\Encryption\SimponiRsaService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * Handle login for portal
 *
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class LoginController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @param Request $request
	 */
    public function __construct(Request $request) {
        $this->middleware('guest.portal', ['except' => 'logout']);
    }

    public function showLoginForm(SimponiRsaService $rsaService) {
    	$data = [
    	    'pageTitle' => 'Login',
            'publicKey' => $rsaService->getPublicKey()
	    ];

        return view('portal.auth.login', $data);
    }

    public function login(Request $request, PortalGuard $auth, SimponiRsaService $rsaService) {
        $this->validateLogin($request);

        try {
            $credentials = [
                'username'      => $rsaService->decrypt($request->input('username')),
                'password'      => $rsaService->decrypt($request->input('password'))
            ];

            $response = $auth->login($credentials);

            if($response['status'])
                return redirect()->route('portal-dashboard');
            else
                return redirect()->back()->withInput(['username' => $credentials['username']])->withErrors($response['message']);
        } catch (\Exception $e) {
            // RSA General Exception
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function showRegistrationForm(SimponiRsaService $rsaService) {
        $data = [
		    'pageTitle' => 'Pendaftaran',
            'publicKey' => $rsaService->getPublicKey()
	    ];

        return view('portal.auth.register', $data);
    }

    public function register(Request $request, PortalApiClientService $apiClient, SimponiRsaService $rsaService) {
        $decrypted = [
            'account'       => $rsaService->decrypt($request->input('account')),
            'username'      => $rsaService->decrypt($request->input('username')),
            'password'      => $rsaService->decrypt($request->input('password'))
        ];

        $request->merge($decrypted);

        $this->validate($request, [
            'account' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email',
            'noId' => 'required',
            'birthdate' => 'required',
            'mobilePhoneNo' => 'required'
        ]);

	    try {
        	$apiClient->post('admin/perorangan/register', ['json' => [
		        'account'       => $request->input('account'),
		        'username'      => $request->input('username'),
		        'password'      => $request->input('password'),
		        'email'         => $request->get('email'),
		        'noId'          => $request->get('noId'),
		        'birthdate'     => date('Y-m-d', strtotime($request->get('birthdate'))),
		        'mobilePhoneNo' => $request->get('mobilePhoneNo'),
	        ]], false);

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
        } catch (\Exception $e) {
            // RSA General Exception
            return redirect()->back()->withErrors($e->getMessage());
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
