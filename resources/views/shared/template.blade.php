<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
        @yield('header')
    </head>
    <body id="page-top">
        @if(\Route::current()->getName() !== 'login' && \Route::current()->getName() !== 'register' && \Route::current()->getName() !== 'password.request')
            @include('shared.navbar')
        @endif

        @if(\Route::current()->getName() !== 'login' && \Route::current()->getName() !== 'register' && \Route::current()->getName() !== 'password.request')
            <div id="wrapper">
                @include('shared.sidenav')
                <div id="content-wrapper">
        @endif
                <div class="container-fluid">
                    @include('shared.message')
                    @yield('content')
                </div>
                @include('shared.footer')

                @if(\Route::current()->getName() !== 'login' && \Route::current()->getName() !== 'register' && \Route::current()->getName() !== 'password.request')
                </div>
            </div>
        @endif

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    </body>
</html>