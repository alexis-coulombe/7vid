@extends('shared.template')

@section('title')
    home
@endsection

@section('description')
    A free video-hosting website that allows members to store and serve video content. Share unlimited video all around the world.
@endsection

@section('content')
    <h1 style="display: none">Home</h1>
    <div class="top-category section-padding mb-4">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="main-title">
                    <h6>Categories</h6>
                </div>
            </div>
            <div class="col-lg-12 mx-auto">
                <div class="owl-carousel owl-carousel-category">
                    @foreach($categories as $category)
                        <a href="{{ route('category.index', ['slug' => $category->getSlug()]) }}">
                            <div class="item">
                                <div class="category-item text-center">
                                    <h3>
                                        <i class="fa {{ $category->icon }}"></i>
                                    </h3>
                                    <h6>{{ $category->getTitle() }}</h6>
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
            <div class="col-lg-10 mx-auto">
                <div class="main-title">
                    <h6>Recently uploaded</h6>
                </div>
            </div>
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    @if(count($newVideos) > 0)
                        @foreach($newVideos as $video)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                @include('shared.video.card')
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="main-title">
                    <h6>Random channels</h6>
                </div>
            </div>
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    @if(count($randomChannels) > 0)
                        @foreach($randomChannels as $channel)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                @include('shared.channel.card')
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(count($categories) > 0)
        @foreach($categories as $category)
            <hr>
            <div class="video-block section-padding">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="main-title">
                            <h6>
                                Most popular videos for <b>{{ $category->getTitle() }}</b> - <a href="{{ route('category.index', ['slug' => $category->getSlug()]) }}">View all</a>
                            </h6>
                        </div>
                    </div>
                    <div class="col-lg-10 mx-auto">
                        <div class="row">
                            @foreach($category->getVideos('views_count', 12) as $video)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    @include('shared.video.card')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div id="scrolling" data-url="{{ route('home.scroll') }}" data-type="channel-video"></div>
    <div class="d-none" id="loading-spinner">
        <div class="row">
            <div class="col text-center">
                @include('shared.misc.loading-spinner')
            </div>
        </div>
    </div>
@endsection
