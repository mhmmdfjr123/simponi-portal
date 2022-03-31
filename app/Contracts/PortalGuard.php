<?php namespace App\Contracts;

/**
 * @author efriandika
 */
interface PortalGuard {

	/**
	 * Attempt to authenticate a user using the given credentials.
	 *
	 * @param array $credentials
	 *
	 * @return array
	 */
	public function login(array $credentials = []);

	/**
	 * Log the user out of the application.
	 *
	 * @return void
	 */
	public function logout();

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
	public function check();

	/**
	 * Determine if the current user is a guest.
	 *
	 * @return bool
	 */
	public function guest();

	/**
	 * Get the currently authenticated user.
	 *
	 * @return Object
	 */
	public function user();

	/**
	 * Get the token for the currently authenticated user.
	 *
	 * @return string
	 */
	public function getToken();

	/**
	 * Get the token expiration time for the currently authenticated user.
	 *
	 * @return string
	 */
	public function getTokenExpiration();

	/**
	 * Get type of account
	 *
	 * @return string
	 */
	public function getAccountType();

	/**
	 * Determine the account type, whether currently account type is an individual
	 *
	 * @return bool
	 */
	public function isIndividual();

	/**
	 * Determine the account type, whether currently account type is a company
	 *
	 * @return bool
	 */
	public function isCompany();
}