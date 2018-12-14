@extends('shared.template')

@section('header')
    <link rel="stylesheet" href="{{ URL::asset('css/plyr.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>{{$video->title}}</h1>

        <video id="player" class="video-js vjs-default-skin" controls preload="auto" poster="">
            <source src="http://dev.test/{{$video->location}}" type="video/{{$video->extension}}">
            To view this video please enable JavaScript, or consider upgrading to a web browser that supports HTML5 video
        </video>
    </div>

    <script src="{{ URL::asset('js/plyr.js') }}"></script>
    <script>const player = new Plyr('#player');</script>
@endsection