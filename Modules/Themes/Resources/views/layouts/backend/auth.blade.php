<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @yield('title')
        </title>

        <link rel="stylesheet" href="{{ asset('modules/theme/backend/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('modules/theme/backend/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/theme/backend/css/adminlte.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            @include('theme::layouts.backend.partials.notifications')
            @yield('content')
        </div>

        <script type="text/javascript" src="{{ asset('modules/theme/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('modules/theme/backend/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('modules/theme/backend/js/adminlte.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('modules/theme/js/jquery.validate.js') }}"></script>
        @stack('js-stack')
    </body>
</html>
