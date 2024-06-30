@extends('themes::layouts.backend.auth.master')
@section('title')    
    login
@endsection
@section('page-title')    
    login
@endsection
@section('content')

        <div class="row">
            <div class="col-lg-6 login-div">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Login</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <form id="login" method="POST" action="{{route('admin.backend.login') }}">
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
                                    <button type="submit" id="submit_button" class="btn btn-primary">
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
                    </div>
                </div>
            </div> 
        </div>
{{--
   
--}}
@endsection
@push('js-stack')
<script>
    $('#submit_button').click(function(e) {
        event.preventDefault();
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
                        pushSuccessMessage('Login',data.message);
                        window.localStorage.setItem('token',data.data.token);   
                        $('#login').submit();
                    }else{
                        if(data.status ==="Error"){
                           pushErrorMessage('Login',data.message);
                        }else{
                            for(var i in data.messages){
                                $(document.getElementsByName(i)).parent().parent().parent().find('.error').html(data.messages[i][0]);
                            }
                        }
                    }
                }
            });   
    });
</script>
@endpush