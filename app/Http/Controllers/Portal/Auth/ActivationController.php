<?php namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

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
	 * @param string $activationCode
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showCompanyActivationForm($activationCode = '') {
    	$data = [
    	    'pageTitle'         => 'Aktivasi Akun Perusahaan',
		    'activationCode'    => $activationCode
	    ];

        return view('portal.auth.activation.company', $data);
    }

	/**
	 * Handle company account activation
	 *
	 * @param Request $request
	 * @param PortalApiClientService $apiClient
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function activateCompany(Request $request, PortalApiClientService $apiClient) {
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
		        'account'       => $request->get('account'),
		        'username'      => $request->get('username'),
		        'password'      => $request->get('password'),
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
        }
    }
}
