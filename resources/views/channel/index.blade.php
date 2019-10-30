@extends('shared.template')

@section('content')
    <div class="single-channel-page" id="content-wrapper">
        <div class="single-channel-image">
            <img class="img-fluid" alt="" src="{{ asset('assets/img/channel-banner.png') }}">
            <div class="channel-profile">
                <img class="channel-profile-img" alt="" src="/{{ $author->avatar }}">
                @if(Auth::check() && Auth::id() === $author->id)
                    <div class="social hidden-xs">
                        <a href="#">Edit channel page</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="single-channel-nav">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="channel-brand" href="#">{{ $author->name }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Videos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Playlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Discussion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Donate
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control form-control-sm mr-sm-1" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button> &nbsp;&nbsp;&nbsp;
                        @if(Auth::check())
                            @include('shared.video.subscribe-small')
                        @endif
                    </form>
                </div>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="video-block section-padding">
                <div class="row">
                    @if(count($author->videos) > 0)
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
                                <h6>Videos</h6>
                            </div>
                        </div>
                        @foreach($author->videos as $video)
                            <div class="col-xl-3 col-sm-6 mb-3">
                                @include('shared.video.card')
                            </div>
                        @endforeach
                    @else
                        <p>This user does not have any videos</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
