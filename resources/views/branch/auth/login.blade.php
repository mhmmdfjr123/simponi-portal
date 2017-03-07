@extends('layouts.branch')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Login Branch</h3>

            <form role="form" method="post" action="{{ route('branch-login') }}" class="form-validate">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="username" class="form-control input-lg" placeholder="Username" required>
                        <i class="ion-ios-person-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="password" class="form-control  input-lg" placeholder="Password" required>
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
                    Belum mempunyai akun branch? <a href="javascript:maintenance();" class="btn btn-primary btn-outline">Daftar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        const $formLogin = $(".form-validate");

        $formLogin.submit(function(e){
            if($(this).valid()){
                $('input.form-control').attr('readonly', true);
                $('input[type=checkbox]').attr('readonly', true);
                $('#btn-login').button('loading');
            }
        });
    </script>
@endsection
