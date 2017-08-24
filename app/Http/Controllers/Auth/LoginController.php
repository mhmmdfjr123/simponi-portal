<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Encryption\RsaService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 * @author efriandika
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backoffice/dashboard';

    protected $rsaService;

    /**
     * Create a new controller instance.
     *
     * @param RsaService $rsaService
     */
    public function __construct(RsaService $rsaService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->rsaService = $rsaService;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'publicKey' => $this->rsaService->getPublicKey()
        ]);
    }

    /**
     * Handle login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handleLogin(Request $request) {
        $decrypted = [
            'username' => $this->rsaService->decrypt($request->input('username')),
            'password' => $this->rsaService->decrypt($request->input('password'))
        ];

        $request->merge($decrypted);

        return $this->login($request);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // Users can login with username or email
        $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($field != $this->username())
            $request->merge([$field => $request->input($this->username())]);

        return $request->only($field, 'password');
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
        if(count($user->roles()) == 0){
            return $this->revokeLogin($request)->withErrors([
                $this->username() => 'Maaf anda tidak dapat login karena tidak memiliki hak akses. Harap hubungi administrator untuk info lebih lanjut'
            ]);
        } else if($user->status != config('enums.user.status.active')) {
            return $this->revokeLogin($request)->withErrors([
                $this->username() => 'Akun anda tidak aktif. Hubungi administrator untuk info lebih lanjut.'
            ]);
        }

        // Set Last Login
        $user->last_login = Carbon::now();
        $user->save();

        return redirect()->intended($this->redirectPath());
    }

    public function revokeLogin(Request $request){
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('login');
    }
}
