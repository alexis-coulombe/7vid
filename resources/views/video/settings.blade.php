@extends('shared.template')

@section('title')
    editing {{ $video->title }}
@endsection

@section('content')
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="{{ route('video.update', ['video' => $video->id]) }}" method="POST" id="save-on-keyboard">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
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
                            <img class="img-fluid" loading="lazy" src="/{{ $video->author->avatar }}" alt="">
                            <p><a href="{{ route('channel.index', ['id' => $video->author->id]) }}" aria-label="View channel"><strong>{{ $video->author->name }}</strong></a></p>
                            <small>Published on {{ date('Y-m-d', strtotime($video->created_at)) }}</small>
                        </div>
                        <div class="single-video-title box mb-3">
                            <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
                            <br>
                            <p class="mb-0"><i class="fas fa-eye"></i> {{ $video->getFormatedViewsCount() }} views
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Views are based on unique active users that landed on this page">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </p>
                            <hr>
                            <textarea name="description" class="form-control" required>{{ $video->description }}</textarea>
                            <br>
                            <p class="tags mb-0">
                                <span><a href="#">Uncharted 4</a></span>
                                <span><a href="#">Playstation 4</a></span>
                                <span><a href="#">Gameplay</a></span>
                                <span><a href="#">1080P</a></span>
                                <span><a href="#">+</a></span>
                            </p>
                        </div>
                        <div class="single-video-info-content box mb-3">
                            <h5>Other settings</h5>
                            <hr>
                            <label>Mark video has hidden
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Nobody, but you, will be able to see this video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>
                            <input type="checkbox">

                            <label>Disable comments
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will not be able to comment on your video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>
                            <input type="checkbox">

                            <label>Disable ratings
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will not be able to rate this video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>
                            <input type="checkbox">

                            <label>thumbnail</label>
                            <input type="file" name="thumbnail">
                            <hr>
                        </div>
                    </div>
                    @include('shared.captcha.recaptcha')
                    <button type="submit" class="float-right btn btn-success border-none"> Save Changes or CTRL+S</button>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src='https://vjs.zencdn.net/7.6.5/video.js'></script>
@endsection
