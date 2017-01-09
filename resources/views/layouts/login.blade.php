<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{!! (isset($pageTitle) ? $pageTitle : Config::get('app.name') ) !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/ext/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/ext/vendor/ionicon/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('theme/backoffice/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/pixeladmin.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/themes/dust.min.css') }}" rel="stylesheet" type="text/css">

    <!-- require.js -->
    <script src="{{ asset('theme/backoffice/js/requirejs.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{ asset('theme/backoffice/js/amd') }}'
        });
    </script>

    <!-- Custom styling -->
    <style>
        h2 {
            letter-spacing: -0.9px;
        }

        /*
        div.px-responsive-bg {
            -webkit-filter: blur(30px);
            -moz-filter: blur(25px);
            -o-filter: blur(25px);
            -ms-filter: blur(25px);
            filter: blur(25px);
        }
        */

        .page-signin-header {
            box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
        }

        .page-signin-header .text-default {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: -0.9px;
        }

        .page-signin-header .btn {
            position: absolute;
            top: 11px;
            right: 12px;
        }

        .page-signin-container {
            width: auto;
            margin: 30px 10px;
        }

        .page-signin-container form {
            border: 0;
            box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
        }

        @media (min-width: 544px) {
            .page-signin-container {
                width: 350px;
                margin: 60px auto;
            }
        }
    </style>
    <!-- / Custom styling -->

    @yield('headScript')
</head>
<body>
<div class="page-signin-header p-a-1 text-sm-center bg-white">
    <a class="text-default" href="{{ route('home') }}">
        {{ config('app.name') }}
    </a>
    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>

<div class="page-signin-container" id="page-signin-forgot-form">
    @yield('content')
</div>

<!-- Javascript -->
<script>
    require(['jquery', 'px/extensions/tooltip', 'px/plugins/px-responsive-bg'], function($) {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
            /*
            $('body').pxResponsiveBg({
                backgroundImage: '{{ asset('theme/backoffice/images/bg.jpg') }}',
                overlay:         '#F1EFEB',
                overlayOpacity:  0.3
            });
            */
        });
    });
</script>
<!-- / Javascript -->

@yield('footScript')
</body>
</html>
