@extends('shared.template')

@section('body-class')
    "register-page"
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-image"></div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3">
                    <div id="square7" class="square square-7"></div>
                    <div id="square8" class="square square-8"></div>
                    <div class="card card-register">
                        <div class="card-header">
                            <img class="card-img" src="{{ asset('assets/img/square1.png') }}" alt="Card image">
                            <h4 class="card-title">{{ __('Login') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="register-bg"></div>
            <div id="square1" class="square square-1"></div>
            <div id="square2" class="square square-2"></div>
            <div id="square3" class="square square-3"></div>
            <div id="square4" class="square square-4"></div>
            <div id="square5" class="square square-5"></div>
            <div id="square6" class="square square-6"></div>
        </div>
    </div>
</div>
@endsection

