<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Portal\PortalBaseController;
use Illuminate\Http\Request;

/**
 * Handle 'forgot password feature' in user portal
 *
 * @package App\Http\Controllers\Portal\Auth
 * @author efriandika
 */
class ForgotPasswordController extends PortalBaseController {
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest.portal');
    }

	public function showForgotPasswordForm() {
		$data = [
			'pageTitle' => 'Lupa Password'
		];
		return view('portal.auth.passwords.forgot', $data);
	}

	public function requestToken() {
		return 'Under Construction';
	}

    public function showResetPasswordForm() {
	    $data = [
		    'pageTitle' => 'Reset Password'
	    ];
	    return view('portal.auth.passwords.reset', $data);
    }

    public function resetPassword() {
	    return 'Under Construction';
    }
}
