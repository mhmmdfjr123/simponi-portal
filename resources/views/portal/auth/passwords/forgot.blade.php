@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Lupa Password</h3>

            <form role="form" method="post" action="{{ route('portal-forgot-password') }}" class="form-validate">
                {{ csrf_field() }}

                <div class="alert alert-warning" role="alert">
                    Masukkan nomor akun dan username yang terhubung dengan akun Anda. Kami akan mengirimkan token untuk reset password via email.
                </div>

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="account" class="form-control  input-lg" placeholder="Nomor Akun BNI Simponi" required>
                        <i class="ion-ios-personadd-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="username" class="form-control input-lg" placeholder="Username" required>
                        <i class="ion-ios-person-outline"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary btn-block btn-submit">
                    Kirim
                </button>
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
            }
        });
    </script>
@endsection
