@extends('shared.template')

@section('title')
    {{ $video->getTitle() }} | {{ $video->author()->first()->getName() }}
@endsection

@section('description')
    {{ $video->getTitle() }} by {{ $video->author()->first()->getName() }}
@endsection

@section('content')
    @php
        $total = $upVotes + $downVotes;
    @endphp
    <div class="video-block section-padding">
        @if(isMobile())
            <div class="row">
                <div class="col-md-10">
                    @include('video.sections.video')
                </div>
                <div class="col-md-2">
                    <div class="single-video-right">
                        <div class="row">
                            @include('video.sections.recommended-videos')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($video->setting()->first() && $video->setting()->first()->getAllowComments())
                    <div class="col-lg-10">
                        @include('video.sections.comment')
                    </div>
                @endif
            </div>
        @else
            <div class="row">
                <div class="col-md-10">
                    @include('video.sections.video')
                    <div class="row">
                    @if($video->setting()->first() && $video->setting()->first()->getAllowComments())
                        <div class="col-lg-12">
                            @include('video.sections.comment')
                        </div>
                    @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="single-video-right">
                        <div class="row">
                            @include('video.sections.recommended-videos')
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
