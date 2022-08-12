<!-- resources/views/child.blade.php -->

@extends('layouts.app2')

@section('title', 'Login')

@section('sidebar')
@parent

<!-- <p>This is appended to the master sidebar.</p> -->
@endsection

@section('content')

<div class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="text-center card-header">
        <a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

         <!-- error message -->
         @if ($errors->any())
        <p>
        <div class="text-danger font-weight-bold">
          Whoops! Something went wrong.
        </div>

        <ul class="mt-3 text-sm list-disc list-inside text-danger">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        </p>
        @endif
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3 input-group">
            <input type="email" name="email" class="form-control" placeholder="信箱">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 input-group">
            <input type="password" name="password" class="form-control" placeholder="密碼">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection
