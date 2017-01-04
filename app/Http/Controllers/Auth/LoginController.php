<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
}
