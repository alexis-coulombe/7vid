<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
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

                @include('shared.message')
                @yield('content')
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
    </body>
</html>