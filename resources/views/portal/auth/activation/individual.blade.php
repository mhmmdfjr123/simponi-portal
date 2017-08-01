@extends('layouts.front')

@section('content')
    <div class="container auth-container">
        <div class="auth-content" style="border-style: dashed">
            @if($isActivationSuccess)
                <h3 class="text-secondary">Selamat! Aktivasi Sukses.</h3>

                <div class="icon-confirmation success">
                    <div class="animated bounceIn">
                        <i class="ion-ios-checkmark bounceIn"></i>
                    </div>
                </div>

                <div class="text-center">
                    {!! $message !!}

                    <div style="margin-top: 30px">
                        <a href="{{ route('portal-login') }}" class="btn btn-primary">Login Portal</a>
                    </div>
                </div>
            @else
                <h3 class="text-secondary">Upps! Aktivasi Gagal.</h3>

                <div class="icon-confirmation danger">
                    <div class="animated bounceIn">
                        <i class="ion-ios-close-outline bounceIn"></i>
                    </div>
                </div>

                <div class="text-center">
                    {!! $message !!}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">

    </script>
@endsection
