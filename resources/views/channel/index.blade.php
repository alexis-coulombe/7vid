@extends('shared.template')

@section('body-class')
    "index-page"
@endsection

@section('content')
    <br><br><br>
    @include('shared.message')
    <div class="container">

        <div class="my-3 text-center text-lg-left">@if(count($videos) > 0) {{$videos->links()}}@endif</div>

        <div class="row text-center text-lg-left">

            @if(count($videos) > 0)
                @foreach($videos as $video)
                    @include('shared.video.card')
                @endforeach
        </div>
        @if(count($videos) > 0) {{$videos->links()}}@endif
        @else
            <h4>There's no video :(</h4>

        @endif
    </div>

@endsection