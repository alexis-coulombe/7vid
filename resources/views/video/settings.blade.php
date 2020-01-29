@extends('shared.template')

@section('title')
    Editing {{ $video->title }}
@endsection

@section('content')
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="{{ route('video.update', ['video' => $video->getId()]) }}" method="POST" id="save-on-keyboard">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="single-video-left">
                        <div class="single-video">
                            <video id='my-video' class='video-js vjs-big-play-centered vjs-16-9' controls preload='auto' width="100%" poster="{{ getImage(route('cdn.img'), $video->getThumbnail()) }}" data-setup="{}">
                                <source src="/{{ $video->getLocation() }}" type="{{ $video->getMimeType() }}">
                                <p class='vjs-no-js'>
                                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                                    <a href='https://videojs.com/html5-video-support/' aria-label="Support html5" target='_blank'>supports HTML5 video</a>
                                </p>
                            </video>
                        </div>
                        <div class="single-video-author box mb-3">
                            <img class="lazyload img-fluid mr-2" loading="lazy" data-src="{{ getImage(route('cdn.img.avatar'), $video->author->getAvatar()) }}" alt="Avatar">
                            <p><a href="{{ route('channel.index', ['userId' => $video->author->getId()]) }}" aria-label="View channel"><strong>{{ $video->author->getName() }}</strong></a></p>
                            <small>Published on {{ date('Y-m-d', strtotime($video->created_at)) }}</small>
                        </div>
                        <div class="single-video-title box mb-3">
                            <label for="title">
                                Title
                                <input type="text" name="title" class="form-control" value="{{ $video->getTitle() }}" required>
                            </label>
                            <hr>
                            <label for="description">
                                Description
                                <textarea name="description" class="form-control" required>{{ $video->getDescription() }}</textarea>
                            </label>
                            <hr>
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
                            <label class="toggle-check">
                                <input type="checkbox" name="private" class="toggle-check-input" {{ $video->setting->getPrivate() ? 'checked' : '' }}>
                                <span class="toggle-check-text"></span>
                                Mark video has hidden
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Nobody, but you, will be able to see this video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>

                            <label class="toggle-check">
                                <input type="checkbox" name="allow_comments" class="toggle-check-input" {{ $video->setting->getAllowComments() ? 'checked' : '' }}>
                                <span class="toggle-check-text"></span>
                                Disable comments
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will not be able to comment on your video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>

                            <label class="toggle-check">
                                <input type="checkbox" name="allow_votes" class="toggle-check-input" {{ $video->setting->getAllowVotes() ? 'checked' : '' }}>
                                <span class="toggle-check-text"></span>
                                Disable ratings
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will not be able to rate this video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>

                            <label>thumbnail</label>
                            <input type="file" name="thumbnail">
                            <hr>
                        </div>
                    </div>
                    @include('shared.captcha.recaptcha')
                    <div class="float-right">
                        <button type="submit" class="btn btn-success border-none"> Save Changes</button> {{ isMobile() ? 'or CTRL+S' : '' }}
                    </div>
                </form>
                @include('shared.video.delete-button')
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection
