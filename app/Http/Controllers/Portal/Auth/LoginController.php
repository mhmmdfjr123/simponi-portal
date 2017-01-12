<?php namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Portal\PortalBaseController;
use GuzzleHttp\Exception\RequestException;

/**
 * Handle login for portal
 *
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class LoginController extends PortalBaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('portal.auth.login');
    }

    public function login()
    {
        try {
            $response = $this->apiGet('http://172.18.2.112:9090/admin/login');

            dd($response->getHeaders());
        } catch (RequestException $e) {
            echo 'ERR: '.$e->getMessage().'<br /><br />';

            if ($e->hasResponse()) {
                echo \GuzzleHttp\Psr7\str($e->getResponse()).'<br />';
            }
        }

        return 'This is Login';
    }

    public function logout()
    {
        return 'this is portal logout';
    }
}
