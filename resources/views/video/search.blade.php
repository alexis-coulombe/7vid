@extends('shared.template')

@section('content')
    <div class="top-mobile-search">
        <div class="row">
            <div class="col-md-12">
                <form class="mobile-search">
                    <div class="input-group">
                        <input type="text" placeholder="Search for..." class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    @if(count($videos) > 0)
        <div class="video-block section-padding">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <h6>Results for videos</h6>
                    </div>
                </div>
                @foreach($videos as $video)
                    @include('shared.video.card')
                @endforeach
                {{$videos->links()}}
            </div>
        </div>
    @endif
    <hr class="mt-0">
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>Results for Channels</h6>
                </div>
            </div>
            @if(count($authors) > 0)
                @foreach($authors as $author)
                    <div class="col-xl-3 col-sm-6 mb-3">
                <div class="channels-card">
                    @if(Auth::check())
                        @php $authorId = $author->id @endphp

                        <div class="channels-card-image">
                            @include('shared.video.subscribe')
                        </div>
                    @endif
                    <div class="channels-card-body">
                        <div class="channels-title">
                            <a href="{{ route('channel.index', ['id' => $author->id]) }}">{{ $author->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
