@extends('layouts.branch')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Pendaftaran Akun Branch</h3>

            <form role="form" method="post" action="{{ route('branch-register') }}" class="form-register">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="username" value="{{ old('username') }}" id="username" class="form-control input-lg" placeholder="Username" required>
                        <i class="ion-ios-person-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required>
                        <i class="ion-ios-locked-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="noId" value="{{ old('noId') }}" class="form-control input-lg" placeholder="Nomor Identitas" required>
                        <i class="ion-ios-body-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="birthdate" value="{{ old('birthdate') }}" id="dob" class="form-control input-lg" placeholder="Tanggal Lahir" required>
                        <i class="ion-ios-calendar-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="Alamat Email" required>
                        <i class="ion-ios-email-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="mobilePhoneNo" value="{{ old('mobilePhoneNo') }}" class="form-control input-lg" placeholder="Nomor Handphone" required>
                        <i class="ion-iphone" style="margin-right: 5px"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary btn-block" data-loading-text="Mohon Tunggu..." id="btn-register">
                    Daftar
                </button>

                <div class="login-or">
                    <hr class="hr-or">
                    <span class="span-or">atau</span>
                </div>

                <div class="btn-register-group">
                    Sudah mempunyai akun? <a href="{{ route('branch-login') }}" class="btn btn-success btn-outline">Login</a>
                </div>

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
            if($(this).valid()) {
                var enc = new JSEncrypt();
                enc.setPublicKey($('#public-key').val());

                // Encrypt
                var $username = $('#username');
                var $password = $('#password');
                $username.val(enc.encrypt($username.val()));
                $password.val(enc.encrypt($password.val()));

                $('input.form-control').attr('readonly', true);
                $('#btn-register').button('loading');
            }
        });

        $('#dob').datepicker({
            format: "dd-mm-yyyy",
            language: 'id',
            startView: 2,
            maxViewMode: 2,
            autoclose: true,
            todayHighlight: true,
            defaultViewDate: { year: 1991 }
        });
    </script>
@endsection
