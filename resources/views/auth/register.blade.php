@extends('auth.template')

@section('title')
    Register
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
                            <h1 class="h4 mt-3 mb-3">Welcome to 7-Vid</h1>
                            <p>It is a long established fact that a reader <br> will be distracted by the readable.</p>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="input-group">
                                <label for="name">Your username
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Your username" required autofocus>
                                </label>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <label for="email">Your email
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Your email" value="{{ old('email') }}" required>
                                </label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <label for="password">Your password
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                                </label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <label for="password_confirmation">Confirm your password
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
                                </label>
                            </div>
                            <div class="input-group">
                                <label for="country">Where are you ?
                                   <select name="country" class="custom-select">
                                       @foreach(\App\Country::all() as $country)
                                            <option value="{{ $country->getId() }}">{{ $country->getCountryName() }}</option>
                                       @endforeach
                                   </select>
                                </label>
                            </div>
                            <div class="input-group">
                                <label for="avatar">Choose an avatar
                                    <input id="avatar" type="file" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar">
                                </label>
                                @if ($errors->has('avatar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-check text-left">
                                <!--<label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" required>
                                    <span class="form-check-sign"></span>
                                    I agree to the
                                    <a href="/terms">terms and conditions</a>.
                                </label>-->
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" required>
                                    <span class="form-check-sign"></span>
                                    I agree to the
                                    <a href="{{ route('home.privacy') }}">Privacy Policy</a>.
                                </label>
                            </div>
                            <div class="card-footer">
                                @include('shared.captcha.recaptcha')
                                <button type="submit" class="btn btn-outline-primary btn-block btn-lg">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-5">
                            <p class="light-gray">Already have an account? <a href="{{ route('login') }}" aria-label="Sign In">Sign In</a></p>
                        </div>
                    </div>
                </div>
                @include('auth.features')
            </div>
        </div>
    </section>
@endsection
