@extends('shared.template')

@section('content')
    <div class="top-mobile-search">
        <div class="row">
            <div class="col-md-12">
                <form class="mobile-search">
                    <div class="input-group">
                        <label for="search"> Search
                            <input type="text" name="search" class="form-control">
                        </label>
                        <div class="input-group-append">
                            <button type="button" aria-label="Search" class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="top-category section-padding mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" aria-label="filter" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>Channels Categories</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-carousel-category">
                    @foreach($categories as $category)
                        <div class="item">
                            <div class="category-item">
                                <a href="#">
                                    <img class="img-fluid" src="img/s1.png" alt="">
                                    <h6>{{ $category->title }}</h6>
                                    <p>{{ $category->getVideosCount() }} videos</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <h6>Recently uploaded</h6>
                </div>
            </div>
            @if(count($newVideos) > 0)
                <div class="owl-carousel owl-carousel-video-card">
                    @foreach($newVideos as $video)
                        <div class="item">
                            @include('shared.video.card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <hr class="mt-0">
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" aria-label="filter" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>4 random channels</h6>
                </div>
            </div>
            @if(count($newChannels) > 0)
                @foreach($newChannels as $channel)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.channel.card')
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
