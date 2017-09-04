<?php namespace App\Http\Controllers\Branch\Auth;

use App\Contracts\BranchGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\BranchApiClientService;
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
        $this->middleware('guest.branch', ['except' => 'logout']);
    }

    public function showLoginForm(SimponiRsaService $rsaService) {
    	$data = [
    	    'pageTitle' => 'Login',
            'publicKey' => $rsaService->getPublicKey()
	    ];

        return view('branch.auth.login', $data);
    }

    public function login(Request $request, BranchGuard $auth, SimponiRsaService $rsaService) {
        $this->validateLogin($request);

        try {
            $credentials = [
                'username'      => $rsaService->decrypt($request->input('username')),
                'password'      => $rsaService->decrypt($request->input('password'))
            ];

            $response = $auth->login($credentials);

            if($response['status'])
                return redirect()->route('branch-dashboard');
            else
                return redirect()->back()->withInput(['username'])->withErrors($response['message']);
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

        return view('branch.auth.register', $data);
    }

    public function register(Request $request, BranchApiClientService $apiClient, SimponiRsaService $rsaService) {
        $decrypted = [
            'username'      => $rsaService->decrypt($request->input('username')),
            'password'      => $rsaService->decrypt($request->input('password'))
        ];

        $request->merge($decrypted);

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'noId' => 'required',
            'birthdate' => 'required',
            'mobilePhoneNo' => 'required'
        ]);

        try {
            $data = [
                'username'      => $request->input('username'),
                'password'      => $request->input('password'),
                'email'         => $request->get('email'),
                'noId'          => $request->get('noId'),
                'birthdate'     => date('Y-m-d', strtotime($request->get('birthdate'))),
                'mobilePhoneNo' => $request->get('mobilePhoneNo'),
            ];
            $apiClient->post('admin/branch/register', ['json' => $data], false);

            return redirect()->route('branch-login')->with('success', 'Akun anda telah berhasil didaftarkan. Silahkan login.');
        } catch (RequestException $e) {
            if($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody());
                $message = (isset($response->message)) ? $response->message : 'An error occurred, please call the administrator.';
            } else {
                $message = $e->getMessage();
            }

            return redirect()->route('branch-register')
                ->withInput($request->except('password'))
                ->withErrors($message);
        } catch (\Exception $e) {
            // RSA General Exception
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

	/**
	 * Log out
	 *
	 * @param BranchGuard $auth
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function logout(BranchGuard $auth) {
    	$auth->logout();
        return redirect()->route('branch-login')->with('success', 'Logout berhasil.');
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
