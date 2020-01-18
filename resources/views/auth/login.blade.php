@extends('auth.template')

@section('title')
    Connect on your account
@endsection

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
@endsection

@section('content')
    <section class="login-main-wrapper">
        <div class="container-fluid pl-0 pr-0">
            <div class="row no-gutters">
                <div class="col-md-5 p-5 bg-white full-height">
                    <div class="login-main-left">
                        <div class="text-center mb-5 login-main-left-header pt-4">
                            <a href="{{ route('home') }}" aria-label="Home">
                                <img src="{{ asset('assets/img/logo.svg') }}" width="50px" height="50px" class="img-fluid" alt="Logo">
                            </a>
                            <h1 class="h4 mt-3 mb-3">Sign In</h1>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="input-group">
                                <label for="email">Your email
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Your email" value="{{ old('email') }}" required autofocus>
                                </label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <label for="password">Password
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                </label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-check text-left">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-sign"></span>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-primary btn-block btn-lg mb-1">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" aria-label="Request password">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                        <div class="text-center mt-2">
                            <p class="light-gray">Don’t have an account? <a href="{{ route('register') }}" aria-label="Sign up">Sign Up</a></p>
                        </div>
                        <div class="form-group text-center">
                            <p><b>OR</b></p>
                            <button class="btn btn-danger btn-google" onclick="window.location.href='{{ route('oauth.redirect.google') }}'"><i class="fab fa-google"></i> Sign in with <b>Google</b></button>
                        </div>
                    </div>
                </div>
                @include('auth.features')
            </div>
        </div>
    </section>
@endsection
