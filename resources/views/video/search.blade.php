@extends('shared.template')

@section('content')
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
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.video.card')
                    </div>
                @endforeach
                {{ $videos->appends(['video_page' => $videos->currentPage(), 'author_page' => $authors->currentPage()])->links() }}
            </div>
        </div>
    @endif
    @if(count($authors) > 0)
    <hr class="mt-0">
        <div class="video-block section-padding">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <h6>Results for Channels</h6>
                    </div>
                </div>
                @foreach($authors as $author)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.channel.card')
                    </div>
                @endforeach
                {{ $authors->appends(['video_page' => $videos->currentPage(), 'author_page' => $authors->currentPage()])->links() }}
            </div>
        </div>
    @endif
@endsection
