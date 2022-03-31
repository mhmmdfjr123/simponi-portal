@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3 class="text-secondary">Pendaftaran Berhasil</h3>

            <div class="icon-confirmation success">
                <div class="animated bounceIn">
                    <i class="ion-ios-checkmark bounceIn"></i>
                </div>
            </div>

            <div class="text-center">
                Selamat.. Pendaftaran akun baru anda telah berhasil. Silahkan periksa email anda untuk aktivasi akun.
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">

    </script>
@endsection
