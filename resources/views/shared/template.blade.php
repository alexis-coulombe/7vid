<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    </head>
    <body>
        @include('shared.navbar')
        @include('shared.message')
        @yield('content')
        @include('shared.footer')
    </body>
</html>