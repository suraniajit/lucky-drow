<!-- jQuery -->
<script src="{{asset('modules/themes/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('modules/themes/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('modules/themes/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('modules/themes/backend/plugins/sparklines/sparkline.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('modules/themes/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('modules/themes/backend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('modules/themes/backend/dist/js/app.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('modules/themes/backend/dist/js/sweetalert/sweetalert2.js')}}"></script>
<script>
  $('#_auth_key_id').val(window.localStorage.getItem('token'));
</script>
@if(!auth()->user()->hasRole(config('core.super-admin')))
<script src="{{asset('modules/themes/backend/js/custome/balance.js')}}"></script>
@endif
<script>
  const base_url = "{{ url('')}}";
  $(document).ready(function(){
    @if(!auth()->user()->hasRole(config('core.super-admin')))
      getCurrentBalance();
    @endif
  });
</script>