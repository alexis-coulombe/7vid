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
                @foreach($videos as $v)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <a href="/video/{{$v->id}}"><h4 class="card-title"><b>{{strlen($v->title) > 50 ? substr($v->title,0,50)."..." : $v->title}}</b></h4>
                                <div class="card-body" style="padding: 0px">
                                    <img class="card-img-top" width="256px" height="144px" src="/{{$v->thumbnail}}">
                                </div>
                            </a>
                            <hr>
                            <div class="card-text">
                                <p>{{strlen($v->description) > 100 ? substr($v->description,0,100)."..." : $v->description}}</p>
                            </div>
                        </div>
                    </div>

                @endforeach
        </div>
        @if(count($videos) > 0) {{$videos->links()}}@endif
        @else
            <h4>There's no video :(</h4>

        @endif
    </div>

@endsection