@extends('shared.template')

@section('body-class')
    "index-page"
@endsection

@section('content')
    @include('shared.banner')

    <nav class="navbar navbar-expand-lg ">
        <span class="navbar-brand" href="#">Filter by categories: </span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Gaming</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Lifestyle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sport</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Culture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Music</a>
                </li>
            </ul>
    </nav>

    <div class="container">
    <h1 class="my-4 text-center text-lg-left">Videos</h1>

        <div class="row text-center text-lg-left">

        @if(count($videos) > 0)
        @foreach($videos as $v)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <a href="/video/{{$v->id}}"><h5 class="card-title">{{$v->title}}</h5>
                            <div class="card-body" style="padding: 0px">
                                <img class="card-img-top" width="400px" height="300px" src="http://dev.test/{{$v->thumbnail}}">
                            </div>
                        </a>
                        <p class="card-text">{{$v->description}}</p>
                    </div>
                </div>

        @endforeach
        </div>

    @else
    <h4>There's no video :(</h4>

        @endif
</div>

@endsection