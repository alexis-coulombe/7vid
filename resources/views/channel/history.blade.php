@extends('shared.template')

@section('title')
    history
@endsection

@section('content')
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
                    <h6>Watch History</h6>
                </div>
            </div>
            @if(count($videos) > 0)
                @foreach($videos as $video)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.video.card')
                    </div>
                @endforeach
            @else
                <div class="col-sm-3 col-md-3">
                    <h2>Empty!</h2>
                    <p>You have not watched any video yet !</p>
                </div>
                @include('shared.misc.floating-hex')
            @endif
        </div>
    </div>
@endsection
