@extends('layouts.app')

@section('title', 'Login')

@section('content') 
  <div id="content">
    <div class="container-fluid">

      <div class="lock-container">
        <div class="panel panel-default text-center paper-shadow" data-z="0.5">
          <h1 class="text-display-1 text-center margin-bottom-none">Sign In</h1>
{{--           <img src="images/user-default.png" class="img-circle width-80"> --}}
          <div class="panel-body">
            <form method="POST" action="{{ route('login') }}">
                        @csrf
            <div class="form-group">
              <div class="form-control-material">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="E-mail Address" autofocus>

                <label for="username">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-control-material">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter Password" required>

                <label for="password">Password</label>
              </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="checkbox">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            @if($errors->has('email') || $errors->has('password'))
                <div class="alert alert-danger">
                    
            @if ($errors->has('email'))
                <span class="helper-text">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            @if ($errors->has('password'))
                <span class="helper-text">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
                </div>
            @endif

            <button type="submit" class="btn btn-success">Login <i class="fa fa-fw fa-unlock-alt"></i></button>
            </form>
            <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
            <a href="{{ route('register') }}" class="link-text-color">Create account</a><br>
            <a href="{{ url("/") }}" class="link-text-color">Home</a>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
@push('styles')
{{-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"> --}}
@endpush


{{-- 
@push('scripts')
  <script type="text/javascript">
    $(function(){
      
      $btnLogin    = $('#btn-login');
      var href     = '{{url('user/dashboard')}}';

      $btnLogin.on('click', function(){
        var password = $('#password').val();
        var email    = $('#email').val();
        $.ajax({
          url      : '{{url('api/v1/user/login')}}',
          type     : 'post',
          dataType : 'json', 
          data     : { password : password, email : email},
          headers  : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              success:function(data)
              {
                // if(data.success == true){
                //    window.location.href = href;
                // }else{
                //   alert('gagal');
                // }
              }
        });
      });
    }); 
  </script>
@endpush --}}