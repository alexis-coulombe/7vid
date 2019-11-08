@extends('shared.template')

@section('title')
    home
@endsection

@section('content')
    <h1 style="display: none">Home</h1>
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
                    <h6>Categories</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-carousel-category">
                    @foreach($categories as $category)
                        <a href="{{ route('category.index', ['name' => $category->title]) }}">
                            <div class="item">
                                <div class="category-item text-center">
                                    <h3>
                                        <i class="{{ $category->icon }}"></i>
                                    </h3>
                                    <h6>{{ $category->title }}</h6>
                                    <p>{{ $category->getVideosCount() }} videos</p>
                                </div>
                            </div>
                        </a>
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
                    <h6>Random channels</h6>
                </div>
            </div>
            @if(count($randomChannels) > 0)
                @foreach($randomChannels as $channel)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.channel.card')
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <hr class="mt-0">
    @if(count($categories) > 0)
        @foreach($categories as $category)
            <div class="video-block section-padding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-title">
                            <h6>Most popular videos in <b>{{ $category->title  }}</b> - <a href="{{ route('category.index', ['name' => $category->title]) }}">View all</a></h6>
                        </div>
                    </div>
                    @foreach($category->getVideos(12, 'views_count') as $video)
                        <div class="col-sm-12 col-md-4 col-lg-2">
                            @include('shared.video.card')
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
@endsection
