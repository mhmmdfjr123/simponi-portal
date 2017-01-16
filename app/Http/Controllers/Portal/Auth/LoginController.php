<?php namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Portal\PortalBaseController;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

/**
 * Handle login for portal
 *
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class LoginController extends PortalBaseController {

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('guest.portal', ['except' => 'logout']);
    }

    public function showLoginForm() {
        return view('portal.auth.login');
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        $data = [
            'user'          => $request->get('username'),
            'password'      => $request->get('password'),
            'clientType'    => $this->clientType,
            'clientId'      => '-',
        ];

        try {
            $response = $this->apiRequest('POST', 'admin/login', ['json' => $data]);
            $body = json_decode($response->getBody());

            $this->setToken($body->tokenJWT);
            $this->setSession($body->personal);

            return $this->authenticated($request, $body);
        } catch (RequestException $e) {
            if($e->hasResponse() && $e->getResponse()->getStatusCode() == 401) {
                $response = json_decode($e->getResponse()->getBody());

                return redirect()->route('portal-login')->withErrors([
                    'username' => (isset($response->message)) ? $response->message : 'Unauthorized, please login..'
                ]);
            } else if($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody());

                return redirect()->back()->withErrors([
                    (isset($response->message)) ? $response->message : 'An error occurred, please call your administrator.'
                ]);
            } else {
                return redirect()->back()->withErrors([
                    $e->getMessage()
                ]);
            }
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    public function authenticated(Request $request, $user)
    {
        return redirect()->route('portal-dashboard');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);
    }

    public function logout()
    {
        $this->clearSession();
        return redirect()->route('portal-login');
    }
}
