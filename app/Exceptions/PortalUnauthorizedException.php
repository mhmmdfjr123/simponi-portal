<?php namespace App\Exceptions;

use Exception;

class PortalUnauthorizedException extends Exception {

	/**
	 * PortalTokenExpiredException constructor.
	 *
	 * @param string $message
	 * @param int $code
	 * @param Exception|null $previous
	 */
	public function __construct($message = 'You are not authorized to access this page.', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}