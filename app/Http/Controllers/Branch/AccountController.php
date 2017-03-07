<?php namespace App\Http\Controllers\Branch;

use App\Contracts\BranchGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\BranchApiClientService;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Branch
 * @author efriandika
 */
class AccountController extends Controller
{
	protected $auth;

	public function __construct(BranchGuard $auth) {
		$this->auth = $auth;
	}

	public function searchAccount(Request $request)
    {
    	$this->validate($request, [
    		'accountCustomer'   => 'required'
	    ]);

		return redirect()->route('branch-account', [encrypt($request->get('accountCustomer'))]);
    }

    public function showAccount($encryptedId, BranchApiClientService $apiClient) {
	    try {
		    $id = $this->decryptId($encryptedId);

		    $rawResponse = $apiClient->post('api/branch/perorangan/detail', ['json' => [
			    'account'   => $this->auth->user()->account,
			    'username'  => $this->auth->user()->username,
			    'accountCustomer'  => $id
		    ]]);

		    $response = json_decode($rawResponse->getBody());

		    if(isset($response->account) && $response->account != null){
			    $data = [
				    'pageTitle' => 'Branch Portal: Pengelolaan Akun',
				    'user'      => $this->auth->user(),
				    'customer'  => $response,
				    'encryptedId'   => $encryptedId
			    ];

			    return view('branch.account.accountDetail', $data);
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

		    return redirect()->route('branch-dashboard')->withErrors($message);
	    }
    }

    public function activateAccount($encryptedId, BranchApiClientService $apiClient) {
	    try {
		    $id = $this->decryptId($encryptedId);

		    $apiClient->post('api/branch/perorangan/aktivasi', ['json' => [
			    'account'   => $this->auth->user()->account,
			    'username'  => $this->auth->user()->username,
			    'accountCustomer'  => $id
		    ]]);

		    return redirect()->route('branch-account', [$encryptedId])->with('success', 'Akun '.$id.' berhasil diaktivasi');
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

    public function showChangeEmailForm($encryptedId, Request $request) {
		if (!$request->ajax())
			return redirect()->route('branch-account', [$encryptedId]);

		return view('branch.account.changeEmail', [
			'encryptedId'   => $encryptedId
		]);
    }

	public function changeEmail($encryptedId, BranchApiClientService $apiClient, Request $request) {
		try {
			$id = $this->decryptId($encryptedId);

			$apiClient->post('api/branch/perorangan/changeemail', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer'  => $id,
				'email'     => $request->get('email')
			]]);

			return redirect()->route('branch-account', [$encryptedId])->with('success', 'Email akun '.$id.' berhasil diganti');
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

	public function blockAccount($encryptedId, BranchApiClientService $apiClient) {
		try {
			$id = $this->decryptId($encryptedId);

			$apiClient->post('api/branch/perorangan/blokir', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer'  => $id
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

	public function unblockAccount($encryptedId, BranchApiClientService $apiClient) {
		try {
			$id = $this->decryptId($encryptedId);

			$apiClient->post('api/branch/perorangan/unblokir', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer'  => $id
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

	public function deleteAccount($encryptedId, BranchApiClientService $apiClient) {
		try {
			$id = $this->decryptId($encryptedId);

			$apiClient->post('api/branch/perorangan/delete', ['json' => [
				'account'   => $this->auth->user()->account,
				'username'  => $this->auth->user()->username,
				'accountCustomer'  => $id
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

	private function decryptId($encryptedId){
		try {
			return decrypt($encryptedId);
		} catch (Exception $e) {
			\Log::error('ID Decryption in '.static::class.' is invalid. Error: '.$e->getMessage());
			abort(404);
		}
	}
}
