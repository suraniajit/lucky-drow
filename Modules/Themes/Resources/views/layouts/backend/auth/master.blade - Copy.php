<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="{{asset('modules/themes/backend/css/custom.css')}}">
  <link rel="stylesheet" href="{{asset('modules/themes/backend/auth/css/style.css')}}">
@stack('css-stack')
</head>
<body>
<div id="bg"></div>
    <div class="__notification">
    </div>
    @yield('content')
</body>
<script src="{{asset('modules/themes/backend/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('modules/themes/backend/js/custome/notification_messages.js')}}"></script>
@stack('js-stack')
</html>
