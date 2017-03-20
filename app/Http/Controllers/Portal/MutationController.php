<?php namespace App\Http\Controllers\Portal;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * @author efriandika
 */
class MutationController extends Controller
{

	protected $auth;

	public function __construct(PortalGuard $auth) {
		$this->auth = $auth;
	}


	/**
	 * Show mutation page.
	 *
	 * @param null $accountTrxList
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function showMutations($accountTrxList = null)
    {
    	$data = [
    		'pageTitle'         => 'Mutasi Transaksi',
		    'accountTrxList'    => $accountTrxList
	    ];

        return view('portal.mutation.showMutations', $data);
    }

    public function getMutations(PortalApiClientService $apiClient, Request $request){
    	$this->validate($request, [
    		'dateStart' => 'required|date_format:"d-m-Y"',
		    'dateEnd'   => 'required|date_format:"d-m-Y"',
	    ]);

    	$dateStart  = date('Y-m-d', strtotime($request->get('dateStart')));
	    $dateEnd    = date('Y-m-d', strtotime($request->get('dateEnd')));

	    try {
		    $rawResponse = $apiClient->post('api/perorangan/mutasi', ['json' => [
			    'dateStart' => $dateStart,
			    'dateEnd'   => $dateEnd,
			    'account'   => $this->auth->user()->account,
			    'username'  => $this->auth->user()->username
		    ]]);

		    $response = json_decode($rawResponse->getBody());

		    return $this->showMutations([
		    	'trxList'   => is_null($response->accountTrxList) ? [] : $response->accountTrxList->trxList,
			    'dateStart' => $request->get('dateStart'),
			    'dateEnd'   => $request->get('dateEnd'),
		    ]);
	    } catch (RequestException $e) {
		    if($e->hasResponse()) {
			    $response = json_decode($e->getResponse()->getBody());
			    $message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
		    } else {
			    $message = $e->getMessage();
		    }

		    return redirect()->route('portal-mutation')->withErrors($message);
	    }


    }
}
