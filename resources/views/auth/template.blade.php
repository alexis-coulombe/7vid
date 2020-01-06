<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="A free video-hosting website that allows members to store and serve video content. Share unlimited video all around the world.">
        <link rel="canonical" href="{{ url()->current() }}">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link href="{{ asset('css/app.css') . '?v=' . filemtime(public_path('css/app.css')) }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') . '?v=' . filemtime(public_path('css/style.css')) }}" rel="stylesheet" type="text/css">
        @yield('header')
    </head>
    <body class="login-main-body">

        @include('shared.message')
        @yield('content')

        <script type="text/javascript" src="{{ asset('js/app.js') . '?v=' . filemtime(public_path('js/app.js')) }}"></script>
    </body>
</html>
