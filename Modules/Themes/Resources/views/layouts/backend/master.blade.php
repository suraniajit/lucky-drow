<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title') | Certify</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('modules/themes/backend/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- sweetalert -->
  <link rel="stylesheet" href="{{asset('modules/themes/backend/css/sweetalert/sweetalert2.css')}}">  
  <link rel="stylesheet" href="{{asset('modules/themes/backend/css/custom.css')}}">
  
  @stack('css-stack')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">

        <a class="dropdown-item" href="{{ route('admin.backend.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa fa-power-off" aria-hidden="true"></i>
        </a>
        <form id="logout-form" action="{{ route('admin.backend.logout') }}" method="POST" class="d-none">
          @csrf
          <input type="hidden" value="" name="_auth_key" id="_auth_key_id">
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-warning">
    <!-- Brand Logo -->
    <a href="{{url('')}}" class="brand-link">
      <img src="{{asset('modules/themes/backend/img/lucky_drow.png')}}" alt="AdminLTE Logo" height="60p">
      <span class="brand-text font-weight-light"></span>
    </a>
    @include('themes::layouts.backend.partials.main_sidebar')
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('page-title')</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
          {{--
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      {{ displayAlert() }}
        <div class="row">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- Main Footer -->
  <footer class="main-footer">
        @include('themes::layouts.backend.partials.footer')
  </footer>
</div>
</body>
   <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('modules/themes/backend/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('modules/themes/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('modules/themes/backend/dist/js/adminlte.min.js')}}"></script>
    <!-- sweetalert -->
    <script src="{{asset('modules/themes/backend/js/sweetalert/sweetalert2.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
      $('#_auth_key_id').val(window.localStorage.getItem('token'));
    </script>
    @stack('js-stack')
</html>
