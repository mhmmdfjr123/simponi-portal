<?php namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

/**
 * Base controller class for portal only in order to handle API request to the server.
 *
 * @package App\Http\Controllers\Portal
 * @author efriandika
 */
class PortalBaseController extends Controller
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new Client([
            'base_uri' => config('app.portal_api_base_uri'),
            // 'timeout'  => 2.0,
        ]);
    }

    protected function apiGet($url)
    {
        return $this->apiClient->get($url);
    }
}