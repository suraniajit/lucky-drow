<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preload" as="style" href="{{asset('modules/themes/backend/dist/css/adminlte.min.css')}}">
  <link rel="preload" as="script" href="{{asset('modules/themes/backend/dist/js/adminlte.js')}}">
  
  <title>@yield('title')</title>
  @include('themes::layouts.backend.partials.master_css')
  @stack('css-stack')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  @include('themes::layouts.backend.partials.pre_loader')
  <!-- Navbar -->
  @include('themes::layouts.backend.partials.main_header')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  sidebar-light-indigo elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('modules/themes/backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    @include('themes::layouts.backend.partials.main_menu')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('page-title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('themes::layouts.backend.partials.footer')
</div>
<!-- ./wrapper -->
@include('themes::layouts.backend.partials.master_js')
@stack('js-stack')
</body>
</html>
