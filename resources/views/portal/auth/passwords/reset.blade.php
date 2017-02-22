@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content">
            <h3>Buat Password Baru</h3>

            <form role="form" method="post" action="{{ route('portal-reset-password') }}" class="form-password">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-login">
                        <input type="text" name="temppas" autocomplete="off" class="form-control input-lg" placeholder="Token (Dikirim via email)" required>
                        <i class="ion-ios-grid-view-outline"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group-login">
                        <input type="password" name="passwordNew" class="form-control  input-lg bniPasswordValidator" data-username="rian" placeholder="Password Baru">
                        <i class="ion-ios-locked-outline"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-submit">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        const $formPassword = $(".form-password");

        $formPassword.validate({
            onkeyup: function(element) {
                this.element(element);
            }
        });

        $formPassword.submit(function(e){
            if($(this).valid()){
                $('input.form-control').attr('readonly', true);
            }
        });
    </script>
@endsection
