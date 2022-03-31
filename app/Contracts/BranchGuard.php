<?php namespace App\Contracts;

/**
 * @author efriandika
 */
interface BranchGuard {

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
	 * Get the currently authenticated user's role.
	 *
	 * @return Object
	 */
	public function isSuperAdmin();

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
}