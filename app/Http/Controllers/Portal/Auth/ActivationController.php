<?php namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use App\Services\Encryption\SimponiRsaService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class ActivationController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @param Request $request
	 */
    public function __construct(Request $request) {
        $this->middleware('guest.portal', ['except' => 'logout']);
    }

    /**
	 * Show activation form for company account
	 *
	 * @param SimponiRsaService $rsaService
     * @param string $activationCode
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showCompanyActivationForm(SimponiRsaService $rsaService, $activationCode = '') {
    	$data = [
    	    'pageTitle'         => 'Aktivasi Akun Perusahaan',
		    'activationCode'    => $activationCode,
            'publicKey'         => $rsaService->getPublicKey()
	    ];

        return view('portal.auth.activation.company', $data);
    }

	/**
	 * Handle company account activation
	 *
	 * @param Request $request
	 * @param PortalApiClientService $apiClient
     * @param SimponiRsaService $rsaService
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function activateCompany(Request $request, PortalApiClientService $apiClient, SimponiRsaService $rsaService) {
        $this->validate($request, [
            'account'   => 'required',
            'username'  => 'required',
            'password'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'code'  => 'required'
        ]);

        try {
        	$apiClient->post('activation/perusahaan/activate', ['json' => [
                'account'       => $rsaService->decrypt($request->input('account')),
                'username'      => $rsaService->decrypt($request->input('username')),
                'password'      => $rsaService->decrypt($request->input('password')),
		        'email'         => $request->get('email'),
		        'phone'         => $request->get('phone'),
		        'code'          => $request->get('code')
	        ]], false);

	        return redirect()->route('portal-login')
		        ->with('success', 'Akun dengan nomor kolektif #'.$request->get('account').' berhasil diaktivasi. Silahkan login.');
        } catch (RequestException $e) {
	        if($e->hasResponse()) {
		        $response = json_decode($e->getResponse()->getBody());
		        $message = (isset($response->message)) ? $response->message : 'An error occurred, please call the administrator.';
	        } else {
		        $message = $e->getMessage();
	        }

	        return redirect()->back()
		        ->withInput($request->except('password'))
		        ->withErrors($message);
        } catch (\Exception $e) {
            // RSA General Exception
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Activate individual account by using activation code
     *
     * @param PortalApiClientService $apiClient
     * @param string $activationCode
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activateIndividualAccount(PortalApiClientService $apiClient, $activationCode) {
        try {
            $rawResponse = $apiClient->get('activation/perorangan/activate/'.$activationCode, [], false);
            $response = json_decode($rawResponse->getBody());

            $message = '<div style="margin-bottom: 5px; font-weight: bold">"'.$response->message.'"</div>';

            if ($response->title == 'SUCCESS') {
                $message .= 'Account anda '.$response->account.' berhasil diaktivasi, silahkan login ke portal BNI Simponi';
                $isActivationSuccess = true;
            } else {
                $message .= 'Account anda gagal diaktivasi. Pastikan link aktivasi yang anda akses benar atau Silahkan hubungi <a href="'.$response->branchLocator.'" target="_blank">kantor cabang</a> terdekat untuk informasi lebih lanjut.';
                $isActivationSuccess = false;
            }

            $data = [
                'pageTitle'         => 'Aktivasi Akun Perorangan',
                'message'           => $message,
                'isActivationSuccess' => $isActivationSuccess
            ];

            return view('portal.auth.activation.individual', $data);
        } catch (RequestException $e) {
            Log::error($e->getMessage());

            if($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody());
                $message = (isset($response->message)) ? $response->message : 'An error occurred, please call the administrator.';
            } else {
                $message = $e->getMessage();
            }

            return redirect()->route('portal-login')->withErrors($message);
        }
    }
}
