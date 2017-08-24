@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>{{ $pageTitle }}</h3>

            <form role="form" method="post" action="{{ route('portal-activation-company-activate') }}" class="form-register">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="account" value="{{ old('account') }}" id="account" class="form-control input-lg" placeholder="Nomor Kolektif Perusahaan" required>
                        <i class="ion-ios-personadd-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="username" value="{{ old('username') }}" id="username" class="form-control input-lg notNumericOnly" placeholder="Username" required minlength="6" maxlength="12">
                        <i class="ion-ios-person-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="password" id="password" class="form-control  input-lg bniPasswordValidator" maxlength="30" data-username-id="username" placeholder="Password">
                        <i class="ion-ios-locked-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="Alamat Email PIC" required>
                        <i class="ion-ios-email-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control input-lg" placeholder="Nomor Telepon PIC" required>
                        <i class="ion-iphone" style="margin-right: 5px"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="code" value="{{ $activationCode }}" class="form-control input-lg" placeholder="Kode Aktivasi" required>
                        <i class="ion-code"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary btn-block" data-loading-text="Mohon Tunggu..." id="btn-register">
                    Aktivasi
                </button>

                <input type="hidden" id="public-key" value="{{ $publicKey }}">
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script src="{{ asset('theme/backoffice/ext/vendor/encryption/jsencrypt.min.js') }}"></script>
    <script type="text/javascript">
        const $formRegister = $(".form-register");

        $formRegister.validate({
            onkeyup: function(element) {
                this.element(element);
            }
        });

        $formRegister.submit(function(e){
            if($(this).valid()){
                var enc = new JSEncrypt();
                enc.setPublicKey($('#public-key').val());

                // Encrypt
                var $account = $('#account');
                var $username = $('#username');
                var $password = $('#password');
                $account.val(enc.encrypt($account.val()));
                $username.val(enc.encrypt($username.val()));
                $password.val(enc.encrypt($password.val()));

                $('input.form-control').attr('readonly', true);
                $('#btn-register').button('loading');
            }
        });

        // Trigger validator to password re-checking, if username is changed
        $('#username').blur(function () {
            $('#password').keyup();
        });
    </script>
@endsection
