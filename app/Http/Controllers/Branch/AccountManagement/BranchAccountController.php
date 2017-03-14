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
class BranchAccountController extends Controller
{
	protected $apiClient;
	protected $auth;

	public function __construct(BranchGuard $auth, BranchApiClientService $apiClient) {
		$this->auth = $auth;
		$this->apiClient = $apiClient;
	}

	/**
	 * Search branch account by using account number
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function searchAccount(Request $request)
    {
    	$this->validate($request, [
    		'accountPerorangan'   => 'required'
	    ]);

		return redirect()->route('branch-account', [encrypt($request->get('accountPerorangan'))]);
    }

	/**
	 * Show account detail by using given account number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function showAccount($encryptedId) {
	    try {
		    $id = $this->decryptId($encryptedId);

		    $rawResponse = $this->apiClient->post('api/branch/perorangan/detail', ['json' => [
			    'account'   => $this->auth->user()->account,
			    'username'  => $this->auth->user()->username,
			    'accountPerorangan' => $id
		    ]]);

		    $response = json_decode($rawResponse->getBody());

		    if(isset($response->account) && $response->account != null){
			    $data = [
				    'pageTitle' => 'Branch Portal: Pengelolaan Akun Branch',
				    'user'      => $this->auth->user(),
				    'customer'  => $response,
				    'encryptedId'   => $encryptedId
			    ];

			    return view('branch.accountManagement.account.accountDetail', $data);
		    } else {
		    	return redirect()->back()->withErrors('Akun '.$id.' tidak ditemukan. Pastikan nomor akun yang anda masukan benar');
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
	 * Block Account based on given account number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function blockAccount($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$this->apiClient->post('api/branch/superadmin/blokir', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer' => $id
			]]);

			return redirect()->route('branch-account', [$encryptedId])->with('success', 'Akun '.$id.' berhasil diblokir');
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-account', [$encryptedId])->withErrors($message);
		}
	}

	/**
	 * Un-Block Account based on given account number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function unblockAccount($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$this->apiClient->post('api/branch/superadmin/unblokir', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer' => $id
			]]);

			return redirect()->route('branch-account', [$encryptedId])->with('success', 'Berhasil buka blokir akun '.$id);
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-account', [$encryptedId])->withErrors($message);
		}
	}

	/**
	 * Delete Account based on given account number
	 *
	 * @param $encryptedId
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteAccount($encryptedId) {
		try {
			$id = $this->decryptId($encryptedId);

			$this->apiClient->post('api/branch/superadmin/delete', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer' => $id
			]]);

			return redirect()->route('branch-dashboard')->with('success', 'Akun '.$id.' berhasil dihapus');
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('branch-account', [$encryptedId])->withErrors($message);
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
