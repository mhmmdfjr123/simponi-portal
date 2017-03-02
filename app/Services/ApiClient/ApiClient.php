<?php namespace App\Services\ApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * @author efriandika
 */
abstract class ApiClient {

	protected $client;

	public function __construct(Request $request) {
		$options = [
			'base_uri'  => config('app.portal.api.base_uri'),
			'headers'   => [
				'Content-Type'  => 'application/json',
				'ClientId'      => $request->ip(),
				'ClientType'    => config('app.portal.api.client_type'),
				'ClientVersion' => '1'
			]
		];

		/*
		$options['handler'] = $this->createLoggingHandlerStack([
			'REQUEST: {method} {uri} HTTP/{version} {request}',
			'RESPONSE: {code} - {res_body}',
		]);
		*/

		$this->client = new Client($options);
	}

	/**
	 * Create and send an HTTP request.
	 *
	 * Use an absolute path to override the base path of the client, or a
	 * relative path to append to the base path of the client. The URL can
	 * contain the query string as well.
	 *
	 * @param $method
	 * @param $uri
	 * @param array $options
	 * @param boolean
	 * @param boolean
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 * @throws \Exception
	 */
	public function request( $method, $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		try {
			if($withAuthentication)
				$options = $this->addAuthorizationHeader($options);

			\Log::info('Send an api request by using method: '.$method.' to '.$uri.' with params: '.var_export($options, true));

			return $this->client->request($method, $uri, $options);
		} catch (RequestException $e) {
			if($useGlobalException && $e->hasResponse() && $e->getResponse()->getStatusCode() == 401) {
				$this->clearAuthSessionData();
				throw $this->unAuthorizedExceptionHandler($e);
			}

			throw $e;
		}
	}

	public function delete( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('DELETE', $uri, $options, $withAuthentication, $useGlobalException);
	}

	public function get( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('GET', $uri, $options, $withAuthentication, $useGlobalException);
	}

	public function head( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('HEAD', $uri, $options, $withAuthentication, $useGlobalException);
	}

	public function options( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('OPTIONS', $uri, $options, $withAuthentication, $useGlobalException);
	}

	public function patch( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('PATCH', $uri, $options, $withAuthentication, $useGlobalException);
	}

	public function post( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('POST', $uri, $options, $withAuthentication, $useGlobalException);
	}

	public function put( $uri, array $options = [], $withAuthentication = true, $useGlobalException = true) {
		return $this->request('PUT', $uri, $options, $withAuthentication, $useGlobalException);
	}

	/**
	 * Handling custom un-authorized exception behavior of Api Request
	 *
	 * @param RequestException $e
	 *
	 * @return RequestException
	 */
	protected function unAuthorizedExceptionHandler(RequestException $e) {
		return $e;
	}

	/**
	 * Append authorization header to headers array of api client
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	abstract protected function addAuthorizationHeader(array $options = []);

	/**
	 * Clear all of auth session data
	 *
	 * @return void
	 */
	abstract protected function clearAuthSessionData();

	/**
	 * Guzzle request logging
	 *
	 * @param array $messageFormats
	 *
	 * @return HandlerStack
	 */
	private function createLoggingHandlerStack(array $messageFormats)
	{
		$stack = HandlerStack::create();

		collect($messageFormats)->each(function ($messageFormat) use ($stack) {
			$stack->unshift(
				Middleware::log(
					with(new Logger('api-consumer'))->pushHandler(
						new RotatingFileHandler(storage_path('logs/api-consumer.log'))
					),
					new MessageFormatter($messageFormat)
				)
			);
		});

		return $stack;
	}
}