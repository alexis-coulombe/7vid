@extends('shared.template')

@section('title')
    videos of {{ $category->getTitle() }}
@endsection

@section('content')
    <h1><i class="{{ $category->getIcon() }}"></i> {{ $category->getTitle() }}</h1>
    <div class="top-category section-padding mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <h5>Videos</h5>
                </div>
            </div>
            @foreach($videos as $video)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 scrolling-prevent" id="{{ $video->getId() }}">
                    @include('shared.video.card')
                </div>
            @endforeach
        </div>
        <div id="scrolling" data-url="{{ route('home.scroll') }}" data-type="category-video" data-category-id="{{ $category->getId() }}"></div>
        <div id="loading-spinner" style="display: none;">
            <div class="row">
                <div class="col text-center">
                    @include('shared.misc.loading-spinner')
                </div>
            </div>
        </div>
    </div>
@endsection
