<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{ url()->current() }}"/>

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
        @yield('head')
    </head>
    <body id="page-top">
            @include('shared.navbar')

            <div id="wrapper">
                @include('shared.sidenav')
                <div id="content-wrapper">
                    <div class="container-fluid">
                        @include('shared.navbar.mobile-search')
                        @include('shared.message')
                        @yield('content')
                    </div>
                </div>
            </div>

        @include('shared.footer')

        <script src="https://browser.sentry-cdn.com/5.7.1/bundle.min.js" integrity="sha384-KMv6bBTABABhv0NI+rVWly6PIRvdippFEgjpKyxUcpEmDWZTkDOiueL5xW+cztZZ" crossorigin="anonymous"></script>
        <script> Sentry.init({ dsn:  '{{ env('SENTRY_LARAVEL_DSN') }}' });</script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/2.0.0/trianglify.min.js" defer></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('js/script.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('js/infiniteScrolling.js') }}" defer></script>
        @yield('footer')
    </body>
</html>
