@extends('shared.template')

@section('body-class')
    "index-page"
@endsection

@section('content')
    @include('shared.banner')

    <nav class="navbar navbar-expand-lg ">
        <span class="navbar-brand" href="#">Filter by categories: </span>
            <ul class="navbar-nav">
                @foreach($categories as $c)
                <li class="nav-item">
                    <a class="nav-link" href="#">{{$c->title}}</a>
                </li>
                @endforeach
            </ul>
    </nav>

    <div class="container">
    <h1 class="my-3 text-center text-lg-left">Videos</h1>

        <div class="row text-center text-lg-left">

        @if(count($videos) > 0)
        @foreach($videos as $v)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <a href="/video/{{$v->id}}"><h4 class="card-title"><b>{{strlen($v->title) > 100 ? substr($v->title,0,100)."..." : $v->title}}</b></h4>
                            <div class="card-body" style="padding: 0px">
                                <img class="card-img-top" width="256px" height="144px" src="http://dev.test/{{$v->thumbnail}}">
                            </div>
                        </a>
                        <hr>
                        <div class="card-text">
                            <p>{{strlen($v->description) > 100 ? substr($v->description,0,100)."..." : $v->description}}</p>
                            <br>
                            <p>Category: {{$categories[$v->category_id-1]->title}}</p>
                        </div>
                    </div>
                </div>

        @endforeach
        </div>

    @else
    <h4>There's no video :(</h4>

        @endif
</div>

@endsection