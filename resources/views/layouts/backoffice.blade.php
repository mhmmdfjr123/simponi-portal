<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>{!! (isset($pageTitle) ? $pageTitle : Config::get('app.name') ) !!}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <link href="http://fonts.googleapis.com/css?family=Lato:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/ext/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/ext/libs/ionicon/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">
    {{--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>--}}

    <link href="{{ asset('theme/backoffice/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/pixeladmin.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/widgets.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/themes/dust.min.css') }}" rel="stylesheet" type="text/css">

    <!-- require.js -->
    <script src="{{ asset('theme/backoffice/js/requirejs.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{ asset('theme/backoffice/js/amd') }}'
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
                <a href="javascript:void(0)" onclick="alertPopUp('Pusat Bantuan', 'Butuh bantuan? <br /> hubungi <strong>efriandika@gmail.com</strong>', 'Tutup')" title="Bantuan" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-support"></i></a>
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
            <a href="{{ route('backoffice-dashboard') }}"><i class="px-nav-icon ion-ios-pulse-strong"></i><span class="px-nav-label">Dashboard</span></a>
        </li>

        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-file-text-o"></i><span class="px-nav-label">Artikel</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Daftar Artikel</span></a></li>
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Buat Artikel Baru</span></a></li>
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Kategori</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-file-o"></i><span class="px-nav-label">Halaman</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Daftar Halaman</span></a></li>
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Buat Halaman Baru</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-desktop"></i><span class="px-nav-label">Tampilan</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item"><a href="javascript:maintenance();"><span class="px-nav-label">Manajemen Menu</span></a></li>
            </ul>
        </li>
        <li class="px-nav-item px-nav-dropdown">
            <a href="#"><i class="px-nav-icon fa fa-users"></i><span class="px-nav-label">Administrasi</span></a>

            <ul class="px-nav-dropdown-menu">
                <li class="px-nav-item" id="menu-user"><a href="{{ url('backoffice/administration/user') }}"><span class="px-nav-label">Pengguna</span></a></li>
            </ul>
        </li>

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
            <li><a href="index.html">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#notifications" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="px-navbar-icon fa fa-bullhorn"></i>
                    <span class="px-navbar-icon-label">Notifications</span>
                    <span class="px-navbar-label label label-success">5</span>
                </a>
                <div class="dropdown-menu p-a-0" style="width: 300px">
                    <div id="navbar-notifications" style="height: 280px; position: relative;">
                        <div class="widget-notifications-item">
                            <div class="widget-notifications-title text-danger">SYSTEM</div>
                            <div class="widget-notifications-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
                            <div class="widget-notifications-date">12h ago</div>
                            <div class="widget-notifications-icon fa fa-hdd-o bg-danger"></div>
                        </div>

                        <div class="widget-notifications-item">
                            <div class="widget-notifications-title text-info">STORE</div>
                            <div class="widget-notifications-description">You have <strong>9</strong> new orders.</div>
                            <div class="widget-notifications-date">12h ago</div>
                            <div class="widget-notifications-icon fa fa-truck bg-info"></div>
                        </div>

                        <div class="widget-notifications-item">
                            <div class="widget-notifications-title text-default">CRON DAEMON</div>
                            <div class="widget-notifications-description">Job <strong>"Clean DB"</strong> has been completed.</div>
                            <div class="widget-notifications-date">12h ago</div>
                            <div class="widget-notifications-icon fa fa-clock-o bg-default"></div>
                        </div>

                        <div class="widget-notifications-item">
                            <div class="widget-notifications-title text-success">SYSTEM</div>
                            <div class="widget-notifications-description">Server <strong>up</strong>.</div>
                            <div class="widget-notifications-date">12h ago</div>
                            <div class="widget-notifications-icon fa fa-hdd-o bg-success"></div>
                        </div>

                        <div class="widget-notifications-item">
                            <div class="widget-notifications-title text-warning">SYSTEM</div>
                            <div class="widget-notifications-description"><strong>Warning</strong>: Processor load <strong>92%</strong>.</div>
                            <div class="widget-notifications-date">12h ago</div>
                            <div class="widget-notifications-icon fa fa-hdd-o bg-warning"></div>
                        </div>
                    </div>

                    <a href="#" class="widget-more-link">MORE NOTIFICATIONS</a>
                </div>
            </li>

            <li class="dropdown">
                <a href="https://google.com" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="px-navbar-icon fa fa-envelope"></i>
                    <span class="px-navbar-icon-label">Income messages</span>
                    <span class="px-navbar-label label label-danger">8</span>
                </a>
                <div class="dropdown-menu p-a-0" style="width: 300px;">
                    <div id="navbar-messages" style="height: 280px; position: relative;">
                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/2.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Robert Jang</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/3.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Michelle Bortz</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/4.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Timothy Owens</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/5.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Denise Steiner</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/2.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Robert Jang</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/3.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Michelle Bortz</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/4.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Timothy Owens</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>

                        <div class="widget-messages-alt-item">
                            <img src="{{ asset('theme/backoffice/demo/avatars/5.jpg') }}" alt="" class="widget-messages-alt-avatar">
                            <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                            <div class="widget-messages-alt-description">from <a href="#">Denise Steiner</a></div>
                            <div class="widget-messages-alt-date">2h ago</div>
                        </div>
                    </div>

                    <a href="#" class="widget-more-link">MORE MESSAGES</a>
                </div> <!-- / .dropdown-menu -->
            </li>

            <li>
                <form class="navbar-form" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" style="width: 140px;">
                    </div>
                </form>
            </li>

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
