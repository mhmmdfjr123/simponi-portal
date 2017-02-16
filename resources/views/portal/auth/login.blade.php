@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Login Portal</h3>

            <form role="form" method="post" action="">
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="username" class="form-control input-lg" placeholder="Username" aria-describedby="input-icon-username">
                        <i class="ion-ios-person-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="password" class="form-control  input-lg" placeholder="Password" aria-describedby="input-icon-password">
                        <i class="ion-ios-locked-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="remember">
                        Ingat Saya
                    </label>
                    <a href="#" class="pull-right">Lupa password?</a>
                    <div class="clearfix"></div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    Login
                </button>

                <div class="login-or">
                    <hr class="hr-or">
                    <span class="span-or">atau</span>
                </div>

                <div class="btn-register-group">
                    Belum mempunyai akun? <a href="#" class="btn btn-primary btn-outline">Daftar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">

    </script>
@endsection
