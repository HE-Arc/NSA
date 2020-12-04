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

            <form method="POST" action="{{ route('register') }}" class="login100-form validate-form" style="font-weight:bold">
                @csrf

                <span class="login100-form-title">
                    {{ __('Register') }}
                </span>

                <div class="wrap-input100 validate-input">
                    <input id="name" type="text" class="input100 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

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

                <div class="wrap-input100 validate-input">
                    <input id="password-confirm" type="password" class="input100 form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn mb-3">
                    <button class="login100-form-btn btn-own-green">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="text-center p-t-15">
                    <a>Already have an account ?</a>
                    <a class="txt2" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection