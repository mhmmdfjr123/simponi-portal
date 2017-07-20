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
	private $accountType = 'PERUSAHAAN';

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
    		'accountPerusahaan'   => 'required',
		    'actionType'          => 'required'
	    ]);

    	$actionType = $request->get('actionType');

    	if($actionType == 'search') {
		    return redirect()->route('branch-company-account', [encrypt(trim($request->get('accountPerusahaan')))]);
	    } else if($actionType == 'register') {
		    return redirect()->route('branch-company-registration', [encrypt(trim($request->get('accountPerusahaan')))]);
	    } else {
    		abort(404);
	    }
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

		    $rawResponse = $this->apiClient->post('api/branch/customer/detail', ['json' => [
			    'account'     => $this->auth->user()->account,
			    'username'    => $this->auth->user()->username,
			    'accountCustomer' => $id,
			    'typeCustomer'    => $this->accountType
		    ]]);

		    $response = json_decode($rawResponse->getBody());

		    if(isset($response->account) && $response->account != null){
			    $data = [
				    'pageTitle' => 'Branch Portal: Pengelolaan Akun Perusahaan',
				    'user'      => $this->auth->user(),
				    'customer'  => $response,
				    'encryptedId'   => $encryptedId
			    ];

			    return view('branch.accountManagement.companyAccount.accountDetail', $data);
		    } else {
			    return redirect()->back()
				    ->withErrors('Akun perusahaan '.$id.' tidak ditemukan atau belum terdaftar di portal')
				    ->with('activeForm', 'company');
		    }
	    } catch (RequestException $e) {
		    if($e->hasResponse()) {
			    $response = json_decode($e->getResponse()->getBody());
			    $message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
		    } else {
			    $message = $e->getMessage();
		    }

		    return redirect()->back()->withErrors($message)->with('activeForm', 'company');
	    }
    }

	/**
	 * Show account detail by using given collective number for registration purpose
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function showAccountForRegistration($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$rawResponse = $this->apiClient->post('api/branch/perusahaan/detail/dplk', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountPerusahaan' => $id
			]]);

			$response = json_decode($rawResponse->getBody());

			// Check required data.
            $customer = $response;
            $notCompleteDataAlert = [];

            if (is_null($customer->nokol) || $customer->nokol == '') {
                $notCompleteDataAlert[] = 'Nomor akun kolektif perusahaan tidak lengkap.';
            }

            if (is_null($customer->companyName) || $customer->companyName == '') {
                $notCompleteDataAlert[] = 'Nama perusahaan tidak lengkap.';
            }

            if (is_null($customer->identityNumber) || $customer->identityNumber == '') {
                $notCompleteDataAlert[] = 'Nomor ID perusahaan tidak lengkap.';
            }

			$data = [
				'pageTitle' => 'Branch Portal: Pengelolaan Akun Perusahaan',
				'user'      => $this->auth->user(),
				'customer'  => $customer,
                'notCompleteDataAlert' => $notCompleteDataAlert,
				'encryptedId' => $encryptedId
			];

			return view('branch.accountManagement.companyAccount.accountDetailForRegistration', $data);
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->back()->withErrors($message)->with('activeForm', 'company');
		}
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
			$this->apiClient->post('api/branch/perusahaan/register', ['json' => [
				'account'         => $this->auth->user()->account,
				'username'        => $this->auth->user()->username,
				'accountPerusahaan'     => $request->get('accountPerusahaan'),
				'namaPerusahaan'        => $request->get('namaPerusahaan'),
				'identityPerusahaan'    => $request->get('identityPerusahaan'),
				'personInChargeEmail'   => $request->get('personInChargeEmail'),
				'personInChargePhone'   => $request->get('personInChargePhone'),
				'tellerInput'           => $this->auth->user()->account,
			]]);

			return redirect()->route('branch-search-portal-account')
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

			return redirect()->route('branch-company-registration', [$encryptedId])
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

			$this->apiClient->post('api/branch/customer/blokir', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountCustomer' => $id,
				'typeCustomer'    => $this->accountType
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

			$this->apiClient->post('api/branch/customer/unblokir', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountCustomer' => $id,
				'typeCustomer'    => $this->accountType
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

			$this->apiClient->post('api/branch/customer/delete', ['json' => [
				'account'     => $this->auth->user()->account,
				'username'    => $this->auth->user()->username,
				'accountCustomer' => $id,
				'typeCustomer'    => $this->accountType
			]]);

			return redirect()->route('branch-search-portal-account')->with([
				'success' => 'Akun perusahan '.$id.' berhasil dihapus',
				'activeForm'    => 'company'
			]);
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
