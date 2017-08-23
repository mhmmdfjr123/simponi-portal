@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Buat Password Baru</h3>

            <form role="form" method="post" action="{{ route('portal-reset-password') }}" class="form-password">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="temppas" id="temppas" autocomplete="off" class="form-control input-lg" placeholder="Token (Dikirim via email)" required>
                        <i class="ion-ios-grid-view-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="passwordNew" id="passwordNew" class="form-control  input-lg bniPasswordValidator" data-username="rian" placeholder="Password Baru">
                        <i class="ion-ios-locked-outline"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block" id="btn-reset-password">
                    Reset Password
                </button>

                <input type="hidden" id="public-key" value="{{ $publicKey }}">
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script src="{{ asset('theme/backoffice/ext/vendor/encryption/jsencrypt.min.js') }}"></script>
    <script type="text/javascript">
        const $formPassword = $(".form-password");

        $formPassword.validate({
            onkeyup: function(element) {
                this.element(element);
            }
        });

        $formPassword.submit(function(e){
            if($(this).valid()){
                var enc = new JSEncrypt();
                enc.setPublicKey($('#public-key').val());

                // Encrypt
                var $temppas = $('#temppas');
                var $passwordNew = $('#passwordNew');
                $temppas.val(enc.encrypt($temppas.val()));
                $passwordNew.val(enc.encrypt($passwordNew.val()));

                $('input.form-control').attr('readonly', true);
                $('#btn-reset-password').button('loading');
            }
        });
    </script>
@endsection
