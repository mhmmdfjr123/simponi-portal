@extends('layouts.login')

@section('content')
    <h2 class="m-t-0 m-b-3 text-xs-center font-weight-semibold font-size-20">
        Register Akun Baru
    </h2>

    <form action="{{ route('portal-register') }}" class="panel p-a-4" method="POST" id="form-login">
        {{ csrf_field() }}

        <fieldset class="form-group form-group-lg{{ $errors->has('accountNumber') ? ' has-error' : '' }} form-message-light">
            <input type="text" class="form-control" placeholder="Masukan Nomor DPLK" name="accountNumber" value="{{ old('accountNumber') }}" required>

            @if ($errors->has('accountNumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('accountNumber') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('username') ? ' has-error' : '' }} form-message-light">
            <input type="text" class="form-control" placeholder="Masukan Username Baru" name="username" value="{{ old('username') }}" required autofocus>

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('password') ? ' has-error' : '' }} form-message-light">
            <input type="password" class="form-control" placeholder="Masukan Password Baru" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </fieldset>

        <fieldset class="form-group form-group-lg{{ $errors->has('email') ? ' has-error' : '' }} form-message-light">
            <input type="email" class="form-control" placeholder="Masukan Email Baru" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </fieldset>

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3" id="btn-login" data-loading-text="Please wait...">Submit</button>
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

        @if(count($errors) > 0 || Session::has('success') || Session::has('warning'))
        require(['jquery', 'px-libs/toastr'], function($, toastr) {
            toastr.options.closeButton = true;

            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}', 'Terjadi suatu kesalahan.');
            @endforeach
        @endif
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}', 'Sukses.');
            @endif
            @if (Session::has('warning'))
                toastr.warning('{{ Session::get('warning') }}', 'Peringatan.');
            @endif
        });
        @endif
    </script>
@endsection
