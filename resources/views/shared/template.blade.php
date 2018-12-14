<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        @yield('header')
    </head>
    <body>
        @include('shared.navbar')
        @include('shared.message')
        @yield('content')
        @include('shared.footer')
    </body>
</html>