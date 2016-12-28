@extends('layouts.login')

@section('content')
    <h2 class="m-t-0 m-b-3 text-xs-center font-weight-semibold font-size-20">
        Login ke Backoffice
    </h2>

    <form action="{{ url('/login') }}" class="panel p-a-4" method="POST" id="form-login">
        {{ csrf_field() }}

        <fieldset class="form-group form-group-lg{{ $errors->has('email') ? ' has-error' : '' }} form-message-light">
            <input type="text" class="form-control" placeholder="Username or Email" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('password') ? ' has-error' : '' }} form-message-light">
            <input type="password" class="form-control" placeholder="Password" name="password" required>

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
            <!-- TODO updated reset password form -->
            {{--<a href="{{ url('/password/reset') }}" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Forgot your password?</a>--}}
        </div>

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3" id="btn-login">Login</button>
    </form>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'px-bootstrap/button', 'px-bootstrap/alert', 'px/plugins/px-validate'], function($) {
            var $formLogin = $("#form-login");

            $formLogin.pxValidate();
            $formLogin.submit(function(e){
                if($(this).valid()){
                    $('input.form-control').attr('readonly', true);
                    $('input[type=checkbox]').attr('readonly', true);
                    $('#btn-login').button('loading');
                }
            });
        });
    </script>
@endsection
