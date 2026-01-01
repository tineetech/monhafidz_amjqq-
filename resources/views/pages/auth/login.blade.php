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
      <div class="form-group has-feedback" style="position: relative;">
        <input
          type="password"
          class="form-control"
          placeholder="Password"
          name="password"
          id="password"
          required
        >

        <span
          class="glyphicon glyphicon-eye-open"
          id="togglePassword"
          style="
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
          "
        ></span>
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
<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password'
      ? 'text'
      : 'password';

    passwordInput.setAttribute('type', type);

    // Ganti icon
    this.classList.toggle('glyphicon-eye-open');
    this.classList.toggle('glyphicon-eye-close');
  });
</script>

@endsection