@extends('layouts.app')

@section('title', 'Registrasi')

@section('content') 

  <div id="content">
    <div class="container-fluid">

      <div class="lock-container">
        <div class="panel panel-default text-center paper-shadow" data-z="0.5">
          <h1 class="text-display-1">Create account</h1>
          <div class="panel-body">

            <!-- Signup -->
            <form method="POST" action="{{ route('register') }}">
                        @csrf
              <div class="form-group">
                <div class="form-control-material">
                  <input id="first_name" type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required autofocus>
                  <label for="first_name">First Name</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-control-material">
                  <input id="lastName" type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                  <label for="lastName">Last name</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-control-material">
                  <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                  <label for="email">Email address</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-control-material">
                  <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-control-material">
                  <input id="passwordConfirmation" type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation" required>
                  <label for="passwordConfirmation">Re-type password</label>
                </div>
              </div>
              <div class="form-group text-center">
                <div class="checkbox">
                  <input type="checkbox" id="agree" name="agreement" value="agree" />
                  <label for="agree">* I Agree with <a href="#">Terms &amp; Conditions!</a></label>
                </div>
              </div>
              @if($errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('agreement'))
                  <div class="alert alert-danger">
                      
              @if ($errors->has('name'))
                  <span class="helper-text">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
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
              @if ($errors->has('agreement'))
                  <span class="helper-text">
                      <strong>{{ $errors->first('agreement') }}</strong>
                  </span>
              @endif
                  </div>
              @endif
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Create an Account</button><br>
                <a href="{{ route('login') }}" class="link-text-color">Login</a> | <a href="{{ url("/") }}" class="link-text-color">Home</a>
              </div>
            </form>
            <!-- //Signup -->

          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
