<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preload" as="style" href="{{asset('modules/themes/backend/dist/css/adminlte.min.css')}}">
    <link rel="preload" as="script" href="{{asset('modules/themes/backend/dist/js/adminlte.js')}}">
    <title>@yield('title')</title>
    @include('themes::layouts.backend.auth.partials.master_css')
    @stack('css-stack')
</head>

<body class="layout-top-nav" style="height: auto;">
    <div class="wrapper">
      <div class="content-wrapper" style="min-height: 212px;">
        @yield('content') 
        <div class="row">
          <div class="__notification">
          </div>
        </div>
      </div>
      @include('themes::layouts.backend.auth.partials.footer')  
    </div>
    @include('themes::layouts.backend.auth.partials.master_js')
    @stack('js-stack')
  </body>
</html>