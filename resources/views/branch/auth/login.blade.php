@extends('layouts.branch')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Login Branch</h3>

            <form role="form" method="post" action="{{ route('branch-login') }}" class="form-validate">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" required>
                        <i class="ion-ios-person-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="password" id="password" class="form-control  input-lg" placeholder="Password" required>
                        <i class="ion-ios-locked-outline"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary btn-block" data-loading-text="Loading..." id="btn-login">
                    Login
                </button>

                <div class="login-or">
                    <hr class="hr-or">
                    <span class="span-or">atau</span>
                </div>

                <div class="btn-register-group">
                    Belum mempunyai akun branch? <a href="{{ route('branch-register') }}" class="btn btn-primary btn-outline">Daftar</a>
                </div>

                <input type="hidden" id="public-key" value="{{ $publicKey }}">
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script src="{{ asset('theme/backoffice/ext/vendor/encryption/jsencrypt.min.js') }}"></script>
    <script type="text/javascript">
        const $formLogin = $(".form-validate");

        $formLogin.submit(function(e){
            if($(this).valid()){
                var enc = new JSEncrypt();
                enc.setPublicKey($('#public-key').val());

                // Encrypt
                var $username = $('#username');
                var $password = $('#password');
                $username.val(enc.encrypt($username.val()));
                $password.val(enc.encrypt($password.val()));

                $('input.form-control').attr('readonly', true);
                $('input[type=checkbox]').attr('readonly', true);
                $('#btn-login').button('loading');
            }
        });
    </script>
@endsection
