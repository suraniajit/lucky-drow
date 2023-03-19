@php 
$theme_data = getThemeString();
@endphp
<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Title -->
        <title>@yield('title') | Certify</title>
       <!-- Favicon -->
        <link rel="icon" href="{{asset('modules/themes/frontend/img/core-img/favicon.ico')}}">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{asset('modules/themes/frontend/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('modules/themes/frontend/css/custom.css')}}">
        @stack('css-stack')
    </head>
    <body>
        @yield('content')
        @include('themes::layouts.frontend.partials.footer')
        <script src="{{ asset('modules/themes/frontend/js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ asset('modules/themes/frontend/js/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('modules/themes/frontend/js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('modules/themes/frontend/js/plugins/plugins.js') }}"></script>
        <script src="{{asset('modules/themes/frontend/js/active.js')}}"></script>
        <script>
            if (window.navigator.userAgent.indexOf("Mobile") > -1) {
                $("#video-viewport").css({"height": "auto"});
            } else {
            }
        </script>
        @stack('js-stack')
    </body>
</html>