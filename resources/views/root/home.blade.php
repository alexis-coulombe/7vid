@extends('shared.template')

@section('content')
    @include('shared.banner')

    <div class="container">
    <h1 class="my-4 text-center text-lg-left">Videos</h1>

    @if(count($videos) > 0)
        @foreach($videos as $v)
            <div class="row text-center text-lg-left">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <a href="/video/{{$v->id}}"><h5 class="card-title">{{$v->title}}</h5>
                            <div class="card-body" style="padding: 0px">
                                <img class="card-img-top" src="http://placehold.it/400x300" alt="Card image cap">
                            </div>
                        </a>
                        <p class="card-text">{{$v->description}}</p>
                    </div>
                </div>
            </div>
        @endforeach

    @else
    <h4>There's no video :(</h4>

        @endif
</div>

@endsection