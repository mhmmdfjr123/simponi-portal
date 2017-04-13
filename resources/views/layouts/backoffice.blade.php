<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>{!! (isset($pageTitle) ? $pageTitle : Config::get('app.name') ) !!}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    {{--<link href="http://fonts.googleapis.com/css?family=Lato:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('theme/backoffice/ext/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/ext/vendor/ionicon/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">
    {{--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>--}}

    <link href="{{ asset('theme/backoffice/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/pixeladmin.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/widgets.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/themes/bni.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('theme/backoffice/ext/vendor/pace/pace.min.js') }}" data-pace-options='{ "document": false }'></script>

    <!-- require.js -->
    <script src="{{ asset('theme/backoffice/js/require.js') }}"></script>
    <script src="{{ asset('theme/backoffice/js/requirejs-config.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{ asset('theme/backoffice/js') }}',
            map: {
                '*': { 'jquery': 'app-default' },
                'app-default': { 'jquery': 'jquery' }
            }
        });
    </script>

    <link href="{{ asset('theme/backoffice/ext/app.css') }}" rel="stylesheet" type="text/css">

    @yield('headScript')
</head>
<body class="px-navbar-fixed">
<nav class="px-nav px-nav-left px-nav-fixed" id="px-nav-main">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
        <span class="px-nav-toggle-arrow"></span>
        <span class="navbar-toggle-icon"></span>
        <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content" id="main-navigation">
        <li class="px-nav-box p-a-3 b-b-1">
            <div class="font-size-16">
                <span class="font-weight-light text-capitalize">Welcome, </span>
                <div><strong>{{ Auth::user()->name }}</strong></div>
            </div>
            <div class="btn-group" style="margin-top: 4px;">
                {{--<a href="javascript:void(0)" onclick="alertPopUp('Pusat Bantuan', 'Butuh bantuan? <br /> hubungi <strong>efriandika@gmail.com</strong>', 'Tutup')" title="Bantuan" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-support"></i></a>--}}
                <a href="{{ url('backoffice/profile/edit') }}" title="Edit Profile" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('logout') }}', 'Konfirmasi Logout', 'Apakah anda yakin ingin keluar?', 'Ya', 'Tidak');" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
            </div>

            <ul class="fa-ul" style="font-size: 9pt; margin-top: 13px">
                @foreach(Auth::user()->roles as $role)
                    <li><i class="fa-li fa fa-arrow-right"></i>{{ $role->name }}</li>
                @endforeach
            </ul>
        </li>

        <li class="px-nav-item">
            <a href="{{ route('backoffice.dashboard') }}"><i class="px-nav-icon ion-ios-pulse-strong"></i><span class="px-nav-label">Dashboard</span></a>
        </li>

        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-file-text-o"></i><span class="px-nav-label">Artikel</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item" id="menu-post"><a href="{{ url('backoffice/post') }}"><span class="px-nav-label">Daftar Artikel</span></a></li>
                <li class="px-nav-item"><a href="{{ url('backoffice/post/add') }}"><span class="px-nav-label">Tambah Artikel Baru</span></a></li>
                <li class="px-nav-item"><a href="{{ url('backoffice/post/category') }}"><span class="px-nav-label">Kategori</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-file-o"></i><span class="px-nav-label">Halaman</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item" id="menu-page"><a href="{{ route('backoffice.page.index') }}"><span class="px-nav-label">Daftar Halaman</span></a></li>
                @permission('approve.page')
                    <li class="px-nav-item" id="menu-page-revision"><a href="{{ route('backoffice.page.revision.approval') }}"><span class="px-nav-label">Persetujuan Revisi Halaman</span></a></li>
                @else
                    <li class="px-nav-item" id="menu-page-revision"><a href="{{ route('backoffice.page.revision.index') }}"><span class="px-nav-label">Daftar Revisi Halaman</span></a></li>
                @endpermission
                <li class="px-nav-item" id="menu-page-new"><a href="{{ route('backoffice.page.add') }}"><span class="px-nav-label">Tambah Halaman Baru</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-download"></i><span class="px-nav-label">Download</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item" id="menu-file-download"><a href="{{ url('backoffice/file/download') }}"><span class="px-nav-label">Daftar File Download</span></a></li>
                <li class="px-nav-item"><a href="{{ url('backoffice/file/download/add') }}"><span class="px-nav-label">Tambah File Download</span></a></li>
                <li class="px-nav-item"><a href="{{ url('backoffice/file/download/category') }}"><span class="px-nav-label">Kategori</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item">
            <a href="{{ url('backoffice/support/faq') }}"><i class="px-nav-icon fa fa-question-circle-o"></i><span class="px-nav-label">FAQ</span></a>
        </li>
        @role('super-administrator')
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-desktop"></i><span class="px-nav-label">Tampilan</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item"><a href="{{ url('backoffice/layout/menu') }}"><span class="px-nav-label">Kelola Menu</span></a></li>
                <li class="px-nav-item" id="menu-layout-banner"><a href="{{ url('backoffice/layout/banner') }}"><span class="px-nav-label">Kelola Banner</span></a></li>
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Kelola Homepage</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-users"></i><span class="px-nav-label">Administrasi</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item" id="menu-user"><a href="{{ url('backoffice/administration/user') }}"><span class="px-nav-label">Pengguna</span></a></li>
            </ul>
        </li>
        @endrole

        <li class="px-nav-box b-t-1 p-a-2">
            <a href="{{ route('home') }}" class="btn btn-primary btn-block btn-outline">Go to Homepage</a>
        </li>
    </ul>
</nav>

<nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
        <a class="navbar-brand px-demo-brand" href="{{ route('backoffice') }}">
            {!! config('app.name') !!}
        </a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('home') }}" target="_blank">Beranda</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu Pintas</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('backoffice/post/add') }}">Buat Artikel Baru</a></li>
                    <li><a href="{{ url('backoffice/file/download/add') }}">Tambah File Download</a></li>
                    @role('super-administrator')
                    <li><a href="{{ url('backoffice/layout/menu') }}">Kelola Menu</a></li>
                    @endrole
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('portal-login') }}" target="_blank">Login Portal</a></li>
                    <li><a href="{{ route('branch-login') }}" target="_blank">Login Branch</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img data-name="{{ Auth::user()->name }}" class="img-profile-name px-navbar-image" />
                    <span class="text-capitalize hidden-md">
                        {{ Auth::user()->name }}
                        <i class="fa fa-sort-desc"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('backoffice/profile/edit') }}">Ubah Profile</a></li>
                    <li><a href="{{ url('backoffice/profile/change-password') }}" class="btn-load-popup">Ganti Password</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('logout') }}', 'Konfirmasi Logout', 'Apakah anda yakin ingin keluar?', 'Ya', 'Tidak');"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Keluar</a></li>
                </ul>
            </li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

<div class="px-content">
    @yield('content')
</div>

<script src="{{ asset('theme/backoffice/ext/app.js') }}"></script>
<script type="text/javascript">
    @if(count($errors) > 0 || Session::has('success') || Session::has('warning'))
    require(['jquery', 'px-libs/toastr'], function($, toastr) {
        toastr.options.closeButton = true;

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Terjadi suatu kesalahan.');
            @endforeach
        @endif
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}', 'Sukses.');
        @endif
        @if (Session::has('warning'))
            toastr.warning('{{ Session::get('warning') }}', 'Peringatan.');
        @endif
    });
    @endif
</script>

@yield('footScript')
</body>
</html>
