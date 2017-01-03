@extends('layouts.login')

<!-- Main Content -->
@section('content')
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Reset Password</h2>

    <form role="form" method="POST" action="{{ url('/password/email') }}" class="panel p-a-4" id="form-forgot-password">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{ csrf_field() }}

        <fieldset class="form-group form-group-lg{{ $errors->has('email') ? ' has-error' : '' }} form-message-light">
            <input type="email" class="form-control" placeholder="Masukan email anda" name="email" value="{{ old('email') }}" required>
        </fieldset>

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3" id="btn-reset">Reset Password</button>
        <div class="m-t-2 text-muted">
            <a href="{{ route('login') }}" id="page-signin-forgot-back">&larr; Login</a>
        </div>
    </form>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'px-bootstrap/button', 'px-bootstrap/alert', 'px/plugins/px-validate'], function($) {
            var $formForgotPassword = $("#form-forgot-password");

            $formForgotPassword.pxValidate();
            $formForgotPassword.submit(function(e){
                if($(this).valid()){
                    $('input.form-control').attr('readonly', true);
                    $('#btn-reset').button('loading');
                }
            });
        });
    </script>
@endsection
