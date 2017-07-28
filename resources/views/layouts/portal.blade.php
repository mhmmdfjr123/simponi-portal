@extends('layouts.front')

@section('headScript')
    @stack('portalHeadScript')
@endsection

@section('content')
    @inject('portalGuard', 'App\Contracts\PortalGuard')

    <div class="container portal-container">
        <div class="row">
            <div class="col-sm-3">
                <div class="portal-sidebar">
                    <!-- Logo for Printing -->
                    <div class="visible-print-block text-center" style="margin: 0 auto 30px auto;">
                        <img src="{{ asset('theme/front/images/logo/BNI-logo.png') }}" style="width: 140px" alt="">
                    </div>
                    
                    <!-- SIDEBAR user-PIC -->
                    <div class="portal-user-pic hidden-xs hidden-print">
                        <img data-name="{{ $portalGuard->user()->name }}"
                             data-font-size="30" data-height="80" data-width="80" data-char-count="2"
                             class="img-responsive name-initializer" alt="">
                    </div>
                    <!-- END SIDEBAR user-PIC -->

                    <!-- SIDEBAR user- TITLE -->
                    <div class="portal-user-title">
                        <div class="portal-user-name">
                            {{ $portalGuard->user()->name }}
                        </div>
                        <div class="portal-user-account">
                            {{ $portalGuard->user()->account }}
                        </div>
                    </div>
                    <!-- END SIDEBAR user- TITLE -->

                    <!-- SIDEBAR BUTTONS -->
                    <div class="portal-user-buttons">
                        <a href="javascript:void(0)" onclick="loadIntoBox('{{ route('portal-change-password') }}')" class="btn btn-primary btn-outline btn-sm hidden-print"><i class="ion-locked"></i> Ubah Password</a>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->

                    <!-- SIDEBAR MENU -->
                    <div class="portal-user-menu hidden-print">
                        <ul class="nav">
                            <li>
                                @if($portalGuard->isIndividual())
                                    <a href="{{ route('portal-dashboard') }}"><i class="fa fa-bar-chart-o"></i> Inquiry Saldo</a>
                                @else
                                    <a href="{{ route('portal-dashboard') }}"><i class="fa fa-download"></i> Download Laporan</a>
                                @endif
                            </li>
                            <li>
                                <a href="{{ route('portal-profile') }}"><i class="fa fa-user-circle-o"></i> Profile </a>
                            </li>
                            @if($portalGuard->isIndividual())
                            <li>
                                <a href="{{ route('portal-mutation') }}"><i class="fa fa-exchange"></i> Mutasi </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('portal-logout') }}" onclick="popUpLoader();"><i class="fa fa-sign-out"></i> Keluar</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-sm-9 portal-content">
                @yield('portalContent')
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        $(function () {
            // Activate current nav item
            var url = String(document.location + '').replace(/\#.*?$/, '');
            $('.portal-user-menu')
                .find('a[href="' + url + '"]')
                .parent()
                .addClass('active');
        });
    </script>

    @stack('portalFootScript')
@endsection