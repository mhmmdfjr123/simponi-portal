<?php namespace App\Services\ApiClient;

use App\Contracts\BranchGuard;
use App\Exceptions\BranchUnauthorizedException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * Api client service for portal branch only
 *
 * @package App\Services
 * @author efriandika
 */
class BranchApiClientService extends ApiClient {

	protected $auth;

	/**
	 * BranchApiClientService constructor.
	 *
	 * @param Request $request
	 * @param BranchGuard $auth
	 */
	public function __construct(Request $request, BranchGuard $auth) {
		parent::__construct($request);
		$this->auth = $auth;
	}

	/**
	 * Handling custom un-authorized exception behavior of Api Request
	 *
	 * @param RequestException $e
	 *
	 * @return BranchUnauthorizedException
	 */
	protected function unAuthorizedExceptionHandler(RequestException $e) {
		if($e->hasResponse()) {
			$response = json_decode($e->getResponse()->getBody());
			$message = (isset($response->message)) ? $response->message : 'Unauthorized, please login..';
		} else
			$message = 'Unauthorized Access';

		return new BranchUnauthorizedException($message);
	}

	/**
	 * Append authorization header to headers array of api client
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	protected function addAuthorizationHeader( array $options = [] ) {
		$options['headers']['Authorization'] = 'Bearer '.$this->auth->getToken();
		return $options;
	}

	/**
	 * Clear all of auth session data
	 *
	 * @return void
	 */
	protected function clearAuthSessionData() {
		$this->auth->logout();
	}
}