@extends('auth::layouts.master')

@section('content')

    <div class="login-box">
        @if ($errors->has('user_name') || $errors->has('password'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                @if ($errors->has('user_name'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('user_name') }}
                </span><br>
                @endif
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('password') }}
                </span>

                @endif
            </div>
    @endif
    <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-logo">
                <a href="/">
                    <img src="{{asset('/frontend/img/logo.png')}}"
                         alt="BL"
                         style="max-height: 100px">

                </a>
            </div>
            <p class="login-box-msg">{{ __('Login') }}</p>
            <form method="POST" action="{{ route($routePrefix.'login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('user_name') ? ' has-error' : '' }}">
                    <input id="user_name" type="text"
                           class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}"
                           placeholder="User Name " name="user_name" value="{{ old('user_name') }}"
                           required autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password"
                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password_confirmation " type="password"
                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Confirm Password" name="password_confirmation" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input class="form-check-input iCheck" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

{{--            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>--}}

        </div>
        <!-- /.login-box-body -->
    </div>

@endsection
