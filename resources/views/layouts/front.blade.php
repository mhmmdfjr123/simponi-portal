<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='keywords' content='{{ $metaKey or 'dplk, bni, pensiun, BNI, simponi' }}' />
    <meta name='description' content='{{ $metaDesc or 'BNI Simponi adalah layanan program pensiun yang diselenggarakan oleh Dana Pensiun Lembaga Keuangan PT. Bank Negara Indonesia (Persero) Tbk (DPLK BNI) sejak tahun 1994 yang Selama 15 tahun terakhir sejak tahun 2001, DPLK BNI berhasil menjadi market leader dalam industri pengelolaan dana pensiun di Indonesia.' }}' />

    <meta property="og:url"                content="{{ \Illuminate\Support\Facades\Request::url() }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ (isset($pageTitle) ? $pageTitle : config('app.name') ) }}" />
    <meta property="og:site_name"          content="{{ config('app.name') }}" />
    <meta property="og:description"        content="{{ $metaDesc or 'BNI Simponi adalah layanan program pensiun yang diselenggarakan oleh Dana Pensiun Lembaga Keuangan PT. Bank Negara Indonesia (Persero) Tbk (DPLK BNI) sejak tahun 1994 yang Selama 15 tahun terakhir sejak tahun 2001, DPLK BNI berhasil menjadi market leader dalam industri pengelolaan dana pensiun di Indonesia.' }}" />
    <meta property="og:image"              content="{{ asset('theme/front/images/logo/BNI-logo.png') }}" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ '@bni' }}">
    <meta name="twitter:creator" content="{{ '@bni' }}">
    <meta name="twitter:title" content="{{ (isset($pageTitle) ? $pageTitle : config('app.name') ) }}">
    <meta name="twitter:description" content="{{ $metaDesc or 'BNI Simponi adalah layanan program pensiun yang diselenggarakan oleh Dana Pensiun Lembaga Keuangan PT. Bank Negara Indonesia (Persero) Tbk (DPLK BNI) sejak tahun 1994 yang Selama 15 tahun terakhir sejak tahun 2001, DPLK BNI berhasil menjadi market leader dalam industri pengelolaan dana pensiun di Indonesia.' }}">
    <meta name="twitter:image" content="{{ asset('theme/front/images/logo/BNI-logo.png') }}">

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
                <button class="hamburger hamburger--spin js-hamburger navbar-toggle visible-xs visible-sm" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
                <a class="navbar-brand page-scroll" href="{{ route('home') }}">
                    <img src="{{ asset('theme/front/images/logo/bni-simponi-normal.png') }}" alt="BNI Simponi" />
                </a>
            </div>

            <div class="navbar-collapse">
                @widget('mainMenu', [])
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    @yield('content')

    {{--<section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h3 class="section-heading">HUBUNGI KAMI</h3>
                    <hr class="title">
                    <p>Hubungi kami di <i>Call Center</i> atau <i>email</i> di bawah dan dapatkan penawaran menarik dari BNI Simponi.</p>
                </div>
                <div class="col-xs-4 col-xs-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p><a href="tel:1500046">1 5000 46</a></p>
                </div>
                <div class="col-xs-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:bnicall@bni.co.id">bnicall@bni.co.id</a></p>
                </div>
            </div>
        </div>
    </section>--}}

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 contact-left">
                    <h4 class="section-heading">Hubungi Kami</h4>
                    <hr class="title">
                    <address>
                        <strong>Butuh bantuan?</strong><br>
                        Hubungi <a href="tel:{{ trim(1500046) }}">1 5000 46</a> atau <a href="tel:{{ trim(68888) }}">68888</a> (melalui ponsel)
                    </address>
                </div>
                <div class="col-sm-8 contact-right hidden-print">
                    <h4 class="section-heading">Investor Relations</h4>
                    <hr class="title">
                    <address class="row">
                        <div class="col-md-4" title="Telepon">
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
                    <small>DPLK BNI terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)</small>
                    <div>Copyright &copy; 2017 - PT. Bank Negara Indonesia (Persero) Tbk.</div>
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