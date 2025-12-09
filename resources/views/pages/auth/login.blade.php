@extends('layouts.auth')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <img src="{{ url('images/logo.png') }}" class="" style="width: 80px" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div style="margin-top: -10px;padding-bottom: 20px">
      <h1 class="text-center text-bold text-black">Login</h1>
      <p class="login-box-msg">untuk monitoring hafalan santri tahfidz</p>
    </div>

    <form action="{{ route('login') }}" method="post">
      @csrf
      @if ($errors->any())
      <div class="alert alert-danger">
              <small>{{ $errors->first() }}</small>
          </div>
      @endif
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
{{-- 
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> --}}
    <!-- /.social-auth-links -->

    {{-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> --}}

  </div>
  <!-- /.login-box-body -->
</div>
@endsection