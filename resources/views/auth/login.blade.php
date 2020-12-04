@extends('layouts.app')

@section('content')

<link href="{{ asset('css/loginregister.css') }}" rel="stylesheet">
<link href="{{ asset('css/util.css') }}" rel="stylesheet">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic">
                <img src="{{ asset('images/logo_nsa.png') }}" alt="IMG">
            </div>

            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form" style="font-weight:bold">
                @csrf

                <span class="login100-form-title">
                    {{ __('Login') }}
                </span>

                <div class="wrap-input100 validate-input">
                    <input id="email" type="email" class="input100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input">
                    <input id="password" type="password" class="input100 form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>

                <div class="container-login100-form-btn mb-3">
                    <button class="login100-form-btn btn-own-green">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="wrap-input100 validate-input text-center">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="text-center p-t-15">
                    <a>Don't have an account ?</a>
                    <a class="txt2" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection