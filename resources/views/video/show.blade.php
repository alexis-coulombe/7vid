@extends('shared.template')

@section('content')
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-9">
                <div class="single-video-left">
                    <div class="single-video">
                        <video id='my-video' class='video-js vjs-big-play-centered vjs-16-9' controls preload='auto' width="100%" controls preload="auto" poster="{{ $video->thumbnail }}" data-setup="{}">
                            <source src="/{{ $video->location }}" type="{{ $video->mime_type }}">
                            <p class='vjs-no-js'>
                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                <a href='https://videojs.com/html5-video-support/' aria-label="Support html5" target='_blank'>supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                    <div class="single-video-author box mb-3">
                        @if(Auth::check() && $video->author->id !== Auth::id())
                            <div class="float-right">
                                @include('shared.video.subscribe')
                            </div>
                        @endif
                        <img class="img-fluid" loading="lazy" src="/{{ $video->author->avatar }}" alt="">
                        <p><a href="{{ route('channel.index', ['id' => $video->author->id]) }}" aria-label="View channel"><strong>{{ $video->author->name }}</strong></a></p>
                        <small>Published on {{ date('Y-m-d', strtotime($video->created_at)) }}</small>
                    </div>
                    <div class="single-video-title box mb-3">
                        @if(Auth::check() && $video->author->id !== Auth::id())
                            <div class="float-right">
                                <a href="{{ route('video.edit', ['id' => $video->id]) }}"><i class="fas fa-cog"></i></a>
                            </div>
                        @endif
                        <h2>{{ $video->title }}</h2>
                        <p class="mb-0"><i class="fas fa-eye"></i> {{ $video->getFormatedViewsCount() }} views
                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Views are based on unique active users that landed on this page">
                                <i class="far fa-question-circle"></i>
                            </span>
                        </p>
                        <hr>
                        <p>{{ $video->description }}</p>
                        <br>
                        <p class="tags mb-0">
                            <span><a href="#">Uncharted 4</a></span>
                            <span><a href="#">Playstation 4</a></span>
                            <span><a href="#">Gameplay</a></span>
                            <span><a href="#">1080P</a></span>
                            <span><a href="#">ps4Share</a></span>
                        </p>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @include('comment.comment-form', $data = ['video_id' => $video->id])
                    @endif

                    @include('comment.show', $data = ['comments' => $comments])
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-video-right">
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
                                <h6>Up Next</h6>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if(count($relatedVideos) > 0)
                                @foreach($relatedVideos as $video)
                                    @include('shared.video.card-small')
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<script>
        let voteup = function(){
            $('.tu').css('color', '#82007d');
            $('.td').css('color', '#B855F5');
            $.ajax({
                url: '/video/vote',
                type: 'POST',
                data: {_token: '<?php echo csrf_token() ?>', value: 1, video_id: '{{$video->id}}'},
                dataType: 'JSON',
                success: function(){
                    location.reload();
                }
            });
        };

        let votedown = function(){
            $('.tu').css('color', '#B855F5');
            $('.td').css('color', '#82007d');
            $.ajax({
                url: '/video/vote',
                type: 'POST',
                data: {_token: '<?php echo csrf_token() ?>', value: 0, video_id: '{{$video->id}}'},
                dataType: 'JSON',
                success: function () {
                    location.reload();
                }
            });
        };
    </script>-->
@endsection

@section('footer')
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src='https://vjs.zencdn.net/7.6.5/video.js'></script>
@endsection
