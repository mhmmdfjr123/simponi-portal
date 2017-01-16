<?php namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Base controller class for portal only in order to handle API request to the server.
 *
 * @package App\Http\Controllers\Portal
 * @author efriandika
 */
class PortalBaseController extends Controller
{
    protected $apiClient;
    protected $clientType = 'web';

    public function __construct()
    {
        $options = [
            'base_uri'  => config('app.portal_api_base_uri'),
            'headers'   => [
                'Content-Type' => 'application/json'
            ]
        ];

        if($this->getToken() != '')
            $options['headers']['Authorization'] = 'Bearer '.$this->getToken();

        $this->apiClient = new Client($options);
    }

    protected function apiRequest($method, $uri = '', array $options = []) {
        try {
            return $this->apiClient->request($method, $uri, $options);
        } catch (RequestException $e) {
            if($e->hasResponse() && $e->getResponse()->getStatusCode() == 401) {
                $this->clearSession();
            }

            throw $e;
        }
    }

    protected function setToken($token) {
        \Session::put('portal_session.jwt_token', $token);
    }

    protected function getToken() {
        return \Session::get('portal_session')['jwt_token'];
    }

    protected function setSession($attr) {
        \Session::put('portal_session.personal', $attr);
    }

    protected function clearSession() {
        \Session::forget('portal_session');
    }
}