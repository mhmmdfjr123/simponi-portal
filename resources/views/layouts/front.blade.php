<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BNI Simponi</title>

    <link href="{{ asset('theme/front/images/favicon.png') }}" rel="shortcut icon" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('theme/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/front/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="{{ asset('theme/front/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/front/vendor/perfect-scrollbar/perfect-scrollbar.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="{{ asset('theme/front/css/simponi.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top">
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top {{ isset($navBarClass) ? $navBarClass : '' }}">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <img src="{{ asset('theme/front/images/BNI-logo-dark.png') }}" alt="BNI Simponi" />
                <img src="{{ asset('theme/front/images/BNI-logo.png') }}" alt="BNI Simponi" />
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <!-- // Sample menu for scroll spy
                <li>
                    <a class="page-scroll" href="#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">Services</a>
                </li>
                <li>
                    <a class="page-scroll" href="#portfolio">Portfolio</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
                -->

                <li class="dropdown">
                    <a href="#">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Sejarah</a></li>
                        <li><a href="#">Struktur Organisasi</a></li>
                        <li><a href="#">Jumlah Aset & Peserta</a></li>
                        <li><a href="#">Alamat Cabang Terdekat</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">Jenis Program</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Individu</a></li>
                        <li><a href="#">Kelompok</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">Jadi Peserta</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Individu</a></li>
                        <li><a href="#">Kelompok</a></li>
                        <li><a href="#">Pembukaan Rekening Baru</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">Pencairan Dana</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Individu</a></li>
                        <li><a href="#">Kelompok</a></li>
                        <li><a href="#">Pembukaan Rekening Baru</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">SIMULASI</a>
                </li>
                <li>
                    <a href="#">FAQ</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">HUBUNGI KAMI</a>
                </li>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li> -->
                <li>
                    <a class="login"><i class="material-icons">launch</i>MASUK</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

@yield('content')

<footer>
    <div class="container">
        <small>Copyright © 2017 PT. Bank Negara Indonesia (Persero) Tbk.</small>
        <img src="{{ asset('theme/front/images/logo_OJK.png') }}" alt="BNI Simponi Otoritas Jasa Keuangan (OJK)">
        <img src="{{ asset('theme/front/images/logo_LPS.png') }}" alt="BNI Simponi Lembaga Penjamin Simpanan (LPS)">
    </div>
</footer>

<div class="loginform">
    <a class="fa fa-close fa-lg"></a>
    <div>
        <b>Masukkan alamat <i>email</i> dan kata sandi Anda untuk masuk.</b>
        <form>
            <img src="{{ asset('theme/front/images/BNI-logo-dark.png') }}" alt="BNI Simponi" />
            <small>Email</small>
            <input type="text" />
            <small>Kata Sandi</small>
            <input type="password" />
            <small class="forgotpassword"><a href="#">Lupa kata sandi?</a></small>
            <button class="btn btn-lg btn-primary">MASUK</button>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('theme/front/vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('theme/front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{ asset('theme/front/vendor/scrollreveal/scrollreveal.min.js') }}"></script>
<script src="{{ asset('theme/front/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('theme/front/vendor/perfect-scrollbar/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('theme/front/vendor/chartjs/chart.min.js') }}"></script>

<!-- Theme JavaScript -->
<script src="{{ asset('theme/front/js/simponi.js') }}"></script>
</body>

</html>