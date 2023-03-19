@extends('themes::layouts.backend.auth.master')
@section('title')    
    login
@endsection
@section('page-title')    
    login
@endsection
@section('content')
    <form id="login" method="POST" action="{{route('login') }}">
        @csrf
        <div class="form-field">
            <input id="email" type="email" placeholder="Email / Username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div class="form-field">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-field">
            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
        <div class="form-field">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       
        <div class="form-field">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
        </div>
        <div class="form-field">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif 
        </div>
    </form>
@endsection
@push('js-stack')
<script>
    $('#login').submit(function(e) {
        var email = $('#email').val();
        var password = $('#password').val();
        var from ='web';
        $.ajax({
                type: 'post',
                url: "{{route('api.admin.login')}}",
                data: {
                    email:email,
                    password:password,
                    from:from,
                },
                headers: {
                    'Authorization': 'Bearer ' ,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: " ",
                    clientsecret: " ",
                },
                beforeSend: function() {},
                success: function(data) {
                    if(data.status=='Success'){
                       window.localStorage.setItem('token',data.data.token);   
                    }
                }
            });   
    });
</script>
@endpush