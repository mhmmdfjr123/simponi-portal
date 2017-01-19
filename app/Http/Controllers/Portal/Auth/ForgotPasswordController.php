<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Portal\PortalBaseController;

class ForgotPasswordController extends PortalBaseController {
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest.portal');
    }

    public function showResetPasswordForm() {

    }

    public function requestToken() {

    }

    public function showLoginWithTokenForm() {

    }

    public function loginWithToken() {

    }
}
