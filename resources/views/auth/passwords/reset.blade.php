@extends('layouts.login')

@section('headScript')
    <script>
        requirejs.config({
            paths:{
                "JSEncrypt": "{{ asset('theme/backoffice/ext/vendor/encryption/jsencrypt.min') }}"
            }
        });
    </script>
@endsection

@section('content')
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Reset Password</h2>

    <form role="form" method="POST" action="{{ url('/password/reset') }}" class="panel p-a-4" id="form-forgot-password">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <fieldset class="form-group form-group-lg{{ $errors->has('email') ? ' has-error' : '' }} form-message-light">
            <input type="email" class="form-control" placeholder="Masukan email anda" name="email" id="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('password') ? ' has-error' : '' }} form-message-light">
            <input type="password" class="form-control" placeholder="Masukan password baru" name="password" id="password" value="" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('password_confirmation') ? ' has-error' : '' }} form-message-light">
            <input type="password" class="form-control" placeholder="Ketik ulang password baru" name="password_confirmation" id="password-confirmation" value="" required>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </fieldset>

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3" id="btn-reset">Reset Password</button>

        <input type="hidden" id="public-key" value="{{ $publicKey }}">
    </form>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'JSEncrypt', 'px-bootstrap/button', 'px-bootstrap/alert', 'px/plugins/px-validate'], function($, jse) {
            var $formForgotPassword = $("#form-forgot-password");

            $formForgotPassword.pxValidate({
                rules: {
                    "email": {
                        required: true,
                        email: true
                    },
                    "password": {
                        required: true,
                        minlength: 8
                    },
                    "password_confirmation": {
                        minlength: 8,
                        equalTo: "#password"
                    }
                }
            });
            $formForgotPassword.submit(function(e){
                if($(this).valid()){
                    var enc = new jse.JSEncrypt();
                    enc.setPublicKey($('#public-key').val());

                    // Encrypt
                    var $email = $('#email');
                    var $password = $('#password');
                    var $passwordConfirmation = $('#password-confirmation');

                    $email.val(enc.encrypt($email.val()));
                    $password.val(enc.encrypt($password.val()));
                    $passwordConfirmation.val(enc.encrypt($passwordConfirmation.val()));

                    $('input.form-control').attr('readonly', true);
                    $('#btn-reset').button('loading');
                }
            });
        });
    </script>
@endsection