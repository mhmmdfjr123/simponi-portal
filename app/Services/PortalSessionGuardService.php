<?php namespace App\Services;

use App\Contracts\PortalGuard;
use App\Services\ApiClient\ApiClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

/**
 * @author efriandika
 */
class PortalSessionGuardService extends ApiClient implements PortalGuard {

	/**
	 * The currently authenticated user.
	 *
	 * @var Object
	 */
	protected $user;

	/**
	 * Indicates if the logout method has been called.
	 *
	 * @var bool
	 */
	protected $loggedOut = false;

	/**
	 * Session instance
	 *
	 * @var Session
	 */
	protected $session;

	public function __construct(Request $request, Session $session) {
		parent::__construct($request);
		$this->session = $session;
	}

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
	public function check() {
		return !is_null($this->user());
	}

	/**
	 * Determine if the current user is a guest.
	 *
	 * @return bool
	 */
	public function guest() {
		return !$this->check();
	}

	/**
	 * Get the currently authenticated user.
	 */
	public function user() {
		if ($this->loggedOut || !$this->session->has($this->getSessionBaseName())) {
			return null;
		}

		// If we've already retrieved the user for the current request we can just
		// return it back immediately. We do not want to fetch the user data on
		// every call to this method because that would be tremendously slow.
		if (! is_null($this->user)) {
			return $this->user;
		}

		$userCredentials = [
			'account'   => $this->session->get($this->getSessionNameOfAccount()),
			'username'  => $this->session->get($this->getSessionNameOfUsername())
		];

		try {
			$response = $this->post('api/perorangan/detail', ['json' => $userCredentials]);

			$user = json_decode($response->getBody());

			$this->session->put($this->getSessionNameOfUserDetail(), $user);

			return $this->user = $user;
		} catch (RequestException $e) {
			if($e->hasResponse() && $e->getResponse()->getStatusCode() == 401) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'Unauthorized, please login..';

				\Session::flash(static::class, $message);

				\Log::info('Access unauthorized. It caused by: '.$message, $userCredentials);

				return null;
			} else if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			\Log::error('An error occurred while requesting user detail in '.static::class.' with message: '.$message);

			abort(500, $message);
		}
	}

	/**
	 * Get the token for currently authenticated user.
	 *
	 * @return int|null
	 */
	public function getToken() {
		return $this->session->get($this->getSessionNameOfToken());
	}

	/**
	 * Get the token expiration time for currently authenticated user.
	 *
	 * @return string
	 */
	public function getTokenExpiration() {
		return $this->session->get($this->getSessionNameOfTokenExpiration());
	}

	/**
	 * Attempt to authenticate a user using the given credentials.
	 *
	 * @param array $credentials
	 *
	 * @return array
	 */
	public function login(array $credentials = []) {
		if( !isset($credentials['username']) ) {
			abort(500, 'Username is not set, please specify username in credentials array');
		}

		$username = $credentials['username'];

		\Log::info('Login to Portal with username: '.$username);

		try {
			$response = $this->post('admin/perorangan/login', ['json' => $credentials], false);
			$responseBody = json_decode($response->getBody());

			$this->updateSession($responseBody->account, $username, $responseBody->tokenJWT, $responseBody->sessionExpires);

			\Log::info('Login successful by using username: '.$username);

			return ['status' => true, 'message' => 'Login Successful'];
		} catch (RequestException $e) {
			\Log::info('Login failed by using username: '.$username);

			if($e->hasResponse() && $e->getResponse()->getStatusCode() == 401) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'Unauthorized, please login..';
			} else if($e->hasResponse()) {
				$response = json_decode($e->getResponse()->getBody());
				$message = (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.';
			} else {
				$message = $e->getMessage();
			}

			return [
				'status'     => false,
				'message'   => $message
			];
		}
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return void
	 */
	public function logout() {
		$userCredentials = [
			'account'   => $this->session->get($this->getSessionNameOfAccount()),
			'username'  => $this->session->get($this->getSessionNameOfUsername())
		];

		try {
			$rawResponse = $this->post('api/perorangan/logout', ['json' => $userCredentials]);
			$response = json_decode($rawResponse->getBody());
		} catch (RequestException $e) {
			\Log::error('An error occurred in logout request. Error: '.$e->getMessage());
		}

		// If we have an event dispatcher instance, we can fire off the logout event
		// so any further processing can be done. This allows the developer to be
		// listening for anytime a user signs out of this application manually.
		$this->clearAuthSessionData();

		// Once we have fired the logout event we will clear the users out of memory
		// so they are no longer available as the user is no longer considered as
		// being signed into this application and should not be available here.
		$this->user = null;

		$this->loggedOut = true;
	}

	/**
	 * Update the session with the given account number, username and token
	 *
	 * @param $account
	 * @param $username
	 * @param $token
	 * @param $tokenExpiration
	 *
	 * @return void
	 */
	protected function updateSession($account, $username, $token, $tokenExpiration)
	{
		$this->session->put($this->getSessionNameOfAccount(), $account);
		$this->session->put($this->getSessionNameOfUsername(), $username);
		$this->session->put($this->getSessionNameOfToken(), $token);
		$this->session->put($this->getSessionNameOfTokenExpiration(), $tokenExpiration);

		$this->session->migrate(true);
	}

	/**
	 * Get a unique identifier for the auth session value.
	 *
	 * @return string
	 */
	protected function getSessionBaseName()
	{
		return 'login_portal_'.sha1(static::class);
	}

	/**
	 * Get auth session identifier for 'user detail' to retrieve data from auth session storage.
	 *
	 * @return string
	 */
	protected function getSessionNameOfUserDetail()
	{
		return $this->getSessionBaseName().'.user';
	}

	/**
	 * Get auth session identifier for 'account' to retrieve data from auth session storage.
	 *
	 * @return string
	 */
	protected function getSessionNameOfAccount()
	{
		return $this->getSessionBaseName().'.account';
	}

	/**
	 * Get auth session identifier for 'username' to retrieve data from auth session storage.
	 *
	 * @return string
	 */
	protected function getSessionNameOfUsername()
	{
		return $this->getSessionBaseName().'.username';
	}

	/**
	 * Get auth session identifier for 'token' to retrieve data from auth session storage.
	 *
	 * @return string
	 */
	protected function getSessionNameOfToken()
	{
		return $this->getSessionBaseName().'.token';
	}

	/**
	 * Get auth session identifier for 'Token Expiration' to retrieve data from auth session storage.
	 *
	 * @return string
	 */
	protected function getSessionNameOfTokenExpiration()
	{
		return $this->getSessionBaseName().'.tokenExpiration';
	}

	/**
	 * Append authorization header to headers array of api client
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	protected function addAuthorizationHeader( array $options = [] ) {
		$options['headers']['Authorization'] = 'Bearer '.$this->getToken();
		return $options;
	}

	/**
	 * Remove the user data from the session storage
	 *
	 * @return void
	 */
	protected function clearAuthSessionData() {
		$this->session->remove($this->getSessionBaseName());
	}
}