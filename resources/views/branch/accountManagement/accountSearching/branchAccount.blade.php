@extends('layouts.branch')

@section('content')
    <div class="container branch-container">
        <h3>{{ $pageTitle }}</h3>
        <hr class="title">

        <p class="help-block">Anda saat ini login sebagai: {{ $user->username }}</p>

        <div class="account-search-box">
            <form class="form-validate" method="post" action="{{ route('branch-search-account') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control input-lg text-center" name="accountPerorangan" placeholder="Username" autocomplete="off" required />
                </div>

                <button type="submit" class="btn btn-primary text-uppercase">
                    <small><i class="ion-ios-search-strong" style="margin-right: 5px"></i> <strong>Cari Akun Branch</strong></small>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        $(function () {
            var $formValidate = $('.form-validate');

            $formValidate.submit(function(e){
                if($(this).valid()){
                    $('input.form-control').attr('readonly', true);
                }
            });
        });
    </script>
@endsection