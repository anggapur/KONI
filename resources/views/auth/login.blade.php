@extends('layouts.appLogin')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('')}}"><b>KONI</b>Badung</a>
  </div>
   @if ($errors->has('email'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-exclamation-triangle"></i> Alert!</h4>
      {{ $errors->first('email') }}
    </div>
  @endif
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

     <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
       
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>   {{ __('Remember Me') }}
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
   

  </div>
  <!-- /.login-box-body -->
</div>
@endsection