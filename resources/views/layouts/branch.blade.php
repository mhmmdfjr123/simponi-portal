<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='keywords' content='{{ $metaKey or settings('meta_key') }}' />
    <meta name='description' content='{{ $metaDesc or e(settings('meta_desc')) }}' />

    <title>{{ $pageTitle or Config::get('app.name') }}</title>

    <link href="{{ asset('theme/front/images/favicon.png') }}" rel="shortcut icon" type="image/x-icon">

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:300,400|Merriweather:400,700|Open+Sans|Roboto:700,400,300" rel="stylesheet">--}}

    <link href="{{ mix('theme/front/css/vendor.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('theme/front/css/simponi.css') }}" rel="stylesheet" type="text/css">

    @yield('headScript')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="{{ isset($bodyClass) ? $bodyClass : '' }}">
    <nav id="main-nav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="{{ route('home') }}">
                    <img src="{{ asset('theme/front/images/logo/bni-simponi-normal.png') }}" alt="BNI Simponi" />
                    <!-- <img src="{{ asset('theme/front/images/logo/BNI-logo.png') }}" alt="BNI Simponi" /> -->
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('home') }}">Quick Links  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('home') }}" target="_blank">Beranda</a></li>
                            <li><a href="{{ route('portal-login') }}" target="_blank">Login Portal</a></li>
                        </ul>
                    </li>

                    @inject('branchGuard', 'App\Contracts\BranchGuard')
                    @if($branchGuard->check())
                        <li class="dropdown">
                            <a class="dropdown-toggle dropdown-menu-dashboard" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('branch-dashboard') }}">Login sebagai: {{ $branchGuard->user()->username }}  <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('branch-dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('branch-logout') }}" onclick="popUpLoader();"><i class="ion-log-out" style="margin-right: 3px"></i> Keluar</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    @yield('content')

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 contact-left">
                    <h4 class="section-heading">Temukan Kami</h4>
                    <hr class="title">
                    <address class="row">
                        {{-- <strong>Butuh bantuan?</strong><br>
                        Hubungi <a href="tel:{{ trim(1500046) }}">1 5000 46</a> atau <a href="tel:{{ trim(68888) }}">68888</a> (melalui ponsel) --}}
                        <div class="col-md-5" title="Instagram">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                            </span>
                            <a href="#">@bnisimponi</a>
                        </div>
                        <div class="col-md-4" title="Facebook">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                            <a href="#">BNI Simponi</a>
                        </div>
                    </address>
                </div>
                <div class="col-sm-7 contact-right hidden-print">
                    <h4 class="section-heading">Unduh Aplikasi</h4>
                    <hr class="title">
                    <address class="row">
                        {{-- <div class="col-md-4" title="Telepon">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                            </span>

                            (021) 5728266
                        </div>
                        <div class="col-md-4" title="Fax">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fa fa-fax fa-stack-1x fa-inverse"></i>
                            </span>
                            (021) 2510175
                        </div> 
                        <div class="col-md-4" title="Email">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                            </span>
                            <a href="mailto:dplk@bni.co.id">dplk@bni.co.id</a>
                        </div> --}}
                        <div class="col-md-3" title="Google Playstore">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fab fa-google-play fa-stack-1x fa-inverse"></i>
                            </span>
                            <a href="#">Simponi Apps</a>
                        </div>
                        <div class="col-md-4" title="Google Playstore">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fab fa-google-play fa-stack-1x fa-inverse"></i>
                            </span>
                            <a href="#">BNI Mobile Banking</a>
                        </div>
                        <div class="col-md-4" title="App Store">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-secondary"></i>
                                <i class="fa fa-apple fa-stack-1x fa-inverse"></i>
                            </span>
                            <a href="#">BNI Mobile Banking</a>
                        </div>
                    </address>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-8 copyright">
                    <div>DPLK BNI terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)</div>
                    <div>Copyright &copy; 2022 - PT. Bank Negara Indonesia (Persero) Tbk.</div>
                </div>
                <div class="col-md-4 footer-logo">
                    <img src="{{ asset('theme/front/images/logo/BNI-logo.png') }}" alt="BNI Simponi Otoritas Jasa Keuangan (OJK)">
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ mix('theme/front/js/vendor.js') }}"></script>
    <script src="{{ mix('theme/front/js/simponi.js') }}"></script>

    @yield('footScript')

    <script type="text/javascript">
        @if((isset($errors) && count($errors) > 0) || Session::has('success') || Session::has('warning'))
            toastr.options.closeButton      = true;
            toastr.options.closeDuration    = 300;
            toastr.options.timeOut          = 30000;

            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif
            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}', 'Sukses.');
            @endif
            @if (Session::has('warning'))
                toastr.warning('{{ Session::get('warning') }}', 'Peringatan.');
            @endif
        @endif
    </script>

    <!--
    " I hate piracy... Don't steal my works to be yours.. "
    Author: Efriandika Pratama <efriandika.pratama[at]bni.co.id>
    -->
</body>
</html>