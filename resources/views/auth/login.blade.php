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
    <h2 class="m-t-0 m-b-3 text-xs-center font-weight-semibold font-size-20">
        Login ke Backoffice
    </h2>

    <form action="{{ url('/login') }}" class="panel p-a-4" method="POST" id="form-login">
        {{ csrf_field() }}

        <fieldset class="form-group form-group-lg{{ $errors->has('username') ? ' has-error' : '' }} form-message-light">
            <input type="text" class="form-control" id="username" placeholder="Username atau Email" name="username" value="{{ old('username') }}" required autofocus>

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('password') ? ' has-error' : '' }} form-message-light">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </fieldset>

        <div class="clearfix">
            <label class="custom-control custom-checkbox pull-xs-left">
                <input type="checkbox" class="custom-control-input" name="remember">
                <span class="custom-control-indicator"></span>
                Ingat Saya
            </label>
            <a href="{{ url('/password/reset') }}" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Lupa password?</a>
        </div>

        <input type="hidden" id="public-key" value="{{ $publicKey }}">

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3" id="btn-login" data-loading-text="Please wait...">Login</button>
    </form>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'JSEncrypt', 'px-bootstrap/button', 'px-bootstrap/alert', 'px/plugins/px-validate'], function($, jse) {
            var $formLogin = $("#form-login");

            $formLogin.pxValidate();
            $formLogin.submit(function(e){
                if($(this).valid()){
                    var enc = new jse.JSEncrypt();
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
        });
    </script>
@endsection
