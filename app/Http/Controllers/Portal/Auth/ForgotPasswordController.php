<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use App\Services\Encryption\SimponiRsaService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

/**
 * Handle 'forgot password feature' in user portal
 *
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class ForgotPasswordController extends Controller {

	protected $session;

    public function __construct(Session $session)
    {
        $this->middleware('guest.portal');

        $this->session = $session;
    }

	public function showForgotPasswordForm(SimponiRsaService $rsaService) {
		$data = [
			'pageTitle' => 'Lupa Password',
            'publicKey' => $rsaService->getPublicKey()
		];
		return view('portal.auth.passwords.forgot', $data);
	}

	public function requestToken(Request $request, PortalApiClientService $apiClient, SimponiRsaService $rsaService) {
		$this->validate($request, [
			'account' => 'required',
			'username' => 'required'
		]);

        try {
            $data = [
                'account'       => $rsaService->decrypt($request->input('account')),
                'username'      => $rsaService->decrypt($request->input('username'))
            ];

			$rawResponse = $apiClient->post('admin/perorangan/forgotpassword', ['json' => $data], false, false);

			// Save jwt token for forgot password in session
			$response = json_decode($rawResponse->getBody());
			$this->session->put($this->getForgotPasswordSessionName(), $response);

			return redirect()->route('portal-reset-password')
				->with('success', 'Silahkan cek email anda ('.$response->email.') untuk mendapatkan token');
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call the administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->back()
			                 ->withErrors($message);
		} catch (\Exception $e) {
		    // RSA General Exception
            return redirect()->back()->withErrors($e->getMessage());
        }
	}

    public function showResetPasswordForm(SimponiRsaService $rsaService) {
    	$this->validateTokenSession();

	    $data = [
		    'pageTitle' => 'Reset Password',
            'publicKey' => $rsaService->getPublicKey()
	    ];
	    return view('portal.auth.passwords.reset', $data);
    }

    public function resetPassword(Request $request, PortalApiClientService $apiClient, SimponiRsaService $rsaService) {
	    $this->validateTokenSession();

	    $this->validate($request, [
		    'temppas' => 'required',
		    'passwordNew' => 'required'
	    ]);

	    $sessionData = $this->session->get($this->getForgotPasswordSessionName());

	    try {
            $data = [
                'json'  => [
                    'account'       => $sessionData->account,
                    'username'      => $sessionData->username,
                    'temppas'       => $rsaService->decrypt($request->input('temppas')),
                    'passwordNew'   => $rsaService->decrypt($request->input('passwordNew')),
                ],
                'headers' => [
                    'Authorization' => 'Bearer '.$sessionData->tokenJWT
                ]
            ];

		    $rawResponse = $apiClient->post('api/perorangan/forgotpassword/logintoken', $data, false, false);
		    $response = json_decode($rawResponse->getBody());

		    // Remove jwt token for forgot password from session
		    $this->session->remove($this->getForgotPasswordSessionName());

		    return redirect()->route('portal-login')
		                     ->with('success', 'Reset password berhasil. Silahkan login');
	    } catch (RequestException $e) {
		    if($e->hasResponse()) {
			    $response = json_decode($e->getResponse()->getBody());
			    $message = (isset($response->message)) ? $response->message : 'An error occurred, please call the administrator.';
		    } else {
			    $message = $e->getMessage();
		    }

		    return redirect()->back()
		                     ->withErrors($message);
	    }
    }

    private function validateTokenSession() {
	    if(!$this->session->has($this->getForgotPasswordSessionName()))
		    return redirect()->route('portal-forgot-password')
		                     ->withErrors('Token sudah expire. Silahkan lakukan permintaan ulang');
    }

    private function getForgotPasswordSessionName() {
    	return 'forgot_password_'.sha1(static::class);
    }
}
