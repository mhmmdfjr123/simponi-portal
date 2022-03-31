<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Encryption\RsaService;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\Auth
 * @author efriandika
 */
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  RsaService $rsaService
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, RsaService $rsaService, $token = null)
    {
        return view('auth.passwords.reset')->with(
            [
                'token' => $token,
                'email' => $request->email,
                'publicKey' => $rsaService->getPublicKey()
            ]
        );
    }

    public function handleResetPassword(Request $request, RsaService $rsaService) {
        $decrypted = [
            'email' => $rsaService->decrypt($request->input('email')),
            'password' => $rsaService->decrypt($request->input('password')),
            'password_confirmation' => $rsaService->decrypt($request->input('password_confirmation'))
        ];

        $request->merge($decrypted);

        return $this->reset($request);
    }
}
