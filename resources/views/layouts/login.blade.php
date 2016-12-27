<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sign In v2 - Pages - PixelAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin" rel="stylesheet" type="text/css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">

    <!-- Light version -->
    <link href="{{ asset('theme/backoffice/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/backoffice/css/pixeladmin.min.css') }}" rel="stylesheet" type="text/css">
    <!-- / -->

    <!-- Theme -->
    <link href="{{ asset('theme/backoffice/css/themes/dust.min.css') }}" rel="stylesheet" type="text/css">
    <!-- / Theme -->

    <!-- require.js -->
    <script src="{{ asset('theme/backoffice/js/requirejs.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: 'theme/backoffice/js/amd'
        });
    </script>

    <!-- Custom styling -->
    <style>
        .page-signin-header {
            box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
        }

        .page-signin-header .btn {
            position: absolute;
            top: 12px;
            right: 15px;
        }

        html[dir="rtl"] .page-signin-header .btn {
            right: auto;
            left: 15px;
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

        .page-signin-social-btn {
            width: 40px;
            padding: 0;
            line-height: 40px;
            text-align: center;
            border: none !important;
        }

        #page-signin-forgot-form { display: none; }
    </style>
    <!-- / Custom styling -->
</head>
<body>
<!-- Javascript -->
<script>
    require(['jquery', 'px/extensions/tooltip', 'px/plugins/px-responsive-bg'], function($) {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>
<!-- / Javascript -->

<div class="page-signin-header p-a-2 text-sm-center bg-white">
    <a class="px-demo-brand px-demo-brand-lg text-default" href="index.html">
        {{ config('app.name') }}
    </a>
    <a href="{{ url('/') }}" class="btn btn-primary">Back to Homepage</a>
</div>

@yield('content')

<!-- Reset form -->
<!--
<div class="page-signin-container" id="page-signin-forgot-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Password reset</h2>

    <form action="index.html" class="panel p-a-4">
        <fieldset class="form-group form-group-lg">
            <input type="email" class="form-control" placeholder="Your Email">
        </fieldset>

        <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send password reset link</button>
        <div class="m-t-2 text-muted">
            <a href="#" id="page-signin-forgot-back">&larr; Back</a>
        </div>
    </form>
</div>
-->
<!-- / Reset form -->

</body>
</html>
