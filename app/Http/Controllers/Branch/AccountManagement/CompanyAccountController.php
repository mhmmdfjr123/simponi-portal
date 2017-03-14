<?php namespace App\Http\Controllers\Branch\AccountManagement;

use App\Contracts\BranchGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\BranchApiClientService;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Branch\AccountManagement
 * @author efriandika
 */
class CompanyAccountController extends Controller
{
	protected $apiClient;
	protected $auth;

	public function __construct(BranchGuard $auth, BranchApiClientService $apiClient) {
		$this->auth = $auth;
		$this->apiClient = $apiClient;
	}

	/**
	 * Search company account by using collective number
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function searchAccount(Request $request)
    {
    	$this->validate($request, [
    		'accountPerusahaan'   => 'required'
	    ]);

		return redirect()->route('branch-company-account', [encrypt($request->get('accountCustomer'))]);
    }

	/**
	 * Show account detail by using given collective number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function showAccount($encryptedId) {
	    try {
		    $id = $this->decryptId($encryptedId);

		    $rawResponse = $this->apiClient->post('api/branch/perusahaan/detail/dplk', ['json' => [
			    'account'     => $this->auth->user()->account,
			    'username'    => $this->auth->user()->username,
			    'accountPerusahaan' => $id
		    ]]);

		    $response = json_decode($rawResponse->getBody());

		    if(isset($response->account) && $response->account != null){
			    $data = [
				    'pageTitle' => 'Branch Portal: Pengelolaan Akun Perusahaan',
				    'user'      => $this->auth->user(),
				    'customer'  => $response,
				    'encryptedId'   => $encryptedId
			    ];

			    // TODO Change $variable in view if the backend for company account is ready.
			    return view('branch.accountManagement.companyAccount.accountDetail', $data);
		    } else {
		    	return redirect()->back()
				    ->withErrors('Akun '.$id.' tidak ditemukan. Pastikan nomor akun yang anda masukan benar')
				    ->with('activeForm', 'company');
		    }
	    } catch (RequestException $e) {
		    if($e->hasResponse()) {
			    $response = json_decode($e->getResponse()->getBody());
			    $message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
		    } else {
			    $message = $e->getMessage();
		    }

		    return redirect()->back()->withErrors($message);
	    }
    }

	/**
	 * Show company registration form
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function showRegistrationForm(Request $request) {
		if (!$request->ajax())
			return redirect()->route('branch-dashboard');

		return view('branch.accountManagement.companyAccount.registration');
	}

	/**
	 * Register company account
	 *
	 * @param Request $request
	 * @param string $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function register(Request $request, $encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$rawResponse = $this->apiClient->post('api/branch/perusahaan/detail/dplk', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountPerusahaan' => $id
			]]);

			$response = json_decode($rawResponse->getBody());

			// TODO Check this registration field name based on server response (If the backend server is up already)
			$this->apiClient->post('api/branch/perusahaan/register', ['json' => [
				'account'         => $this->auth->user()->account,
				'username'        => $this->auth->user()->username,
				'accountPerusahaan'     => $response->accountPerusahaan,
				'namaPerusahaan'        => $response->namaPerusahaan,
				'identityPerusahaan'    => $response->identityPerusahaan,
				'personInChargeEmail'   => $request->get('personInChargeEmail'),
				'personInChargePhone'   => $request->get('personInChargePhone'),
				'tellerInput'           => $this->auth->user()->account,
			]]);

			return redirect()->route('branch-search-company-account')
			                 ->with([
				                 'success'       => 'Perusahaan dengan nomor kolektif '.$request->get('accountPerusahaan').' berhasil didaftarkan.',
				                 'activeForm'    => 'company'
			                 ]);
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-search-company-account')
			                 ->withErrors($message)
			                 ->with('activeForm', 'company');
		}
	}

	/**
	 * Block Account based on given collective number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function blockAccount($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$this->apiClient->post('api/branch/perusahaan/blokir', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountPerusahaan' => $id
			]]);

			return redirect()->route('branch-company-account', [$encryptedId])->with('success', 'Akun '.$id.' berhasil diblokir');
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-company-account', [$encryptedId])->withErrors($message);
		}
	}

	/**
	 * Un-Block Account based on given collective number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function unblockAccount($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$this->apiClient->post('api/branch/perusahaan/unblokir', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountPerusahaan' => $id
			]]);

			return redirect()->route('branch-company-account', [$encryptedId])->with('success', 'Berhasil buka blokir akun '.$id);
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-company-account', [$encryptedId])->withErrors($message);
		}
	}

	/**
	 * Delete account based on given collective number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteAccount($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$this->apiClient->post('api/branch/perusahaan/delete', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountPerusahaan' => $id
			]]);

			return redirect()->route('branch-dashboard')->with('success', 'Akun '.$id.' berhasil dihapus');
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-company-account', [$encryptedId])->withErrors($message);
		}
	}

	/**
	 * Decrypt ID
	 *
	 * @param $encryptedId
	 *
	 * @return string
	 */
	private function decryptId($encryptedId){
		try {
			return decrypt($encryptedId);
		} catch (Exception $e) {
			\Log::error('ID Decryption in '.static::class.' is invalid. Error: '.$e->getMessage());
			abort(404);
		}
	}
}
