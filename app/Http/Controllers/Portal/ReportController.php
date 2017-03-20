<?php namespace App\Http\Controllers\Portal;

use App\Contracts\PortalGuard;
use App\Http\Controllers\Controller;
use App\Services\ApiClient\PortalApiClientService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 * @author efriandika
 */
class ReportController extends Controller
{

	protected $auth;

	/**
	 * ReportController constructor.
	 *
	 * @param $auth
	 */
	public function __construct(PortalGuard $auth) {
		$this->auth = $auth;
	}

	/**
	 * Show download list.
	 *
	 * @param PortalApiClientService $apiClient
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
	 */
    public function showDownloadList(PortalApiClientService $apiClient, Request $request) {
    	$this->validate($request, [
    		'date'  => 'required|date_format:"d-m-Y"'
	    ]);

	    try {
		    $rawResponse = $apiClient->post('api/perusahaan/detail/', ['json' => [
			    'account'   => $this->auth->user()->account,
			    'username'  => $this->auth->user()->username,
			    'date'      => date('Y-m-d', strtotime($request->get('date')))
		    ]]);

		    $response = json_decode($rawResponse->getBody());
		    $reports = $response->accountDetail->fileReportName;

		    if(!is_null($reports)){
			    return view('portal.report.downloads', [
				    'reports'   => $reports,
				    'date'      => $request->get('date')
			    ]);
		    } else {
			    return redirect()->route('portal-dashboard')->withErrors('Laporan untuk tanggal '.$request->get('date').' belum tersedia, silahkan masukan tanggal lain.');
		    }
	    } catch (RequestException $e) {
		    if($e->hasResponse()) {
			    $response = json_decode($e->getResponse()->getBody());
			    $message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
		    } else {
			    $message = $e->getMessage();
		    }

		    return redirect()->route('portal-dashboard')->withErrors($message);
	    }
    }

	/**
	 * Download file
	 *
	 * @param PortalApiClientService $apiClient
	 * @param Request $request
	 * @param $filename
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
	 */
	public function download(PortalApiClientService $apiClient, Request $request, $filename) {
		$date = $request->get('date');

		if (is_null($date))
			abort(404);

		try {
			$rawResponse = $apiClient->post('api/perusahaan/detail/download/', [
				'json' => [
					'account'   => $this->auth->user()->account,
					'username'  => $this->auth->user()->username,
					'date'      => date('Y-m-d', strtotime($date)),
					'filename'  => $filename
				],
				'stream' => true
			]);

			return response()->make($rawResponse->getBody()->getContents(), 200, $rawResponse->getHeaders());
		} catch (RequestException $e) {
			if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return redirect()->route('portal-report', ['date' => $date])->withErrors($message);
		}
	}
}
