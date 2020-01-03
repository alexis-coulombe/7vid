@extends('shared.template')

@section('title')
    {{ $video->getTitle() }} | {{ $video->author->getName() }}
@endsection

@section('content')
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-10">
                <div class="single-video-left">
                    <div class="single-video">
                        <video id='my-video' class='video-js vjs-big-play-centered vjs-16-9' width="100%" controls preload="auto" poster="{{ getImage(route('cdn.img'), $video->getThumbnail()) }}" data-setup="{}">
                            <source src="/{{ $video->getLocation() }}" type="{{ $video->getMimeType() }}">
                            <p class='vjs-no-js'>
                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                <a href='https://videojs.com/html5-video-support/' aria-label="Support html5" target='_blank'>supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                    <div class="single-video-author box mb-3">
                        @if(Auth::check() && $video->author->getId() !== Auth::user()->getId())
                            <div class="float-right mt-2">
                                @include('shared.video.subscribe')
                            </div>
                        @endif
                        <div class="row vertical-center">
                            <img class="img-fluid" loading="lazy" src="{{ getImage(route('cdn.img.avatar'), $video->author->getAvatar()) }}" alt="">
                            <p class="ml-2">
                                <a href="{{ route('channel.index', ['userId' => $video->author->getId()]) }}" aria-label="View channel"><strong>{{ $video->author->getName() }}</strong></a>
                            </p>
                        </div>
                        <small>Published on {{ date('Y-m-d', strtotime($video->created_at)) }}</small>
                    </div>
                    <div class="single-video-title box mb-3">
                        @if($video->setting()->first() && $video->setting()->first()->getAllowVotes())
                            <div class="float-right">
                                <button type="button" class="btn btn-{{ $video->userHasVoted(\App\VideoVote::UPVOTE) ? 'danger' : 'primary' }} vote" data-value="1" data-id="{{ $video->getId() }}" @if(Auth::check()) data-url="{{ route('video.vote') }}" @endif><i class="fas fa-thumbs-up"></i></button>
                                <button type="button" class="btn btn-{{ $video->userHasVoted(\App\VideoVote::DOWNVOTE) ? 'danger' : 'primary' }} vote" data-value="0" data-id="{{ $video->getId() }}" @if(Auth::check()) data-url="{{ route('video.vote') }}" @endif><i class="fas fa-thumbs-down"></i></button>
                                @if($upVotes === $downVotes)
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"></div>
                                    </div>
                                @else
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ ($upVotes / ($upVotes + ($downVotes <= 0 ? 1 : $downVotes)))*100 }}%;"></div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <h1 class="h2">{{ $video->getTitle() }}</h1>
                        <p class="mb-0">
                            <i class="fas fa-eye"></i> {{ $video->getFormatedViewsCount() }} views
                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Views are based on unique active users that landed on this page">
                                <i class="far fa-question-circle"></i>
                            </span>
                        </p>
                        <hr>
                        @include('shared.video.edit-button')
                        <hr>
                        <p>{{ $video->getDescription() }}</p>
                        <br>
                        <p class="tags mb-0">
                            <span><a href="#">Uncharted 4</a></span>
                            <span><a href="#">Playstation 4</a></span>
                            <span><a href="#">Gameplay</a></span>
                            <span><a href="#">1080P</a></span>
                            <span><a href="#">ps4Share</a></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="single-video-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <h6>Up Next</h6>
                            </div>
                        </div>
                        @php $temp = $video @endphp
                        @if(count($relatedVideos) > 0)
                            @foreach($relatedVideos as $video)
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    @include('shared.video.card')
                                </div>
                            @endforeach
                        @endif
                        @php $video = $temp @endphp
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if($video->setting()->first() && $video->setting()->first()->getAllowComments())
                <div class="col-md-10">
                    @include('shared.comment.filter')
                </div>
                <div class="col-lg-10">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @include('comment.comment-form', $data = ['video_id' => $video->getId()])
                    @endif

                    @include('comment.show', $data = ['comments' => $comments])

                    <div id="scrolling" data-url="{{ route('home.scroll') }}" data-type="comment" data-video-id="{{ $video->getId() }}"></div>
                    <div id="loading-spinner" style="display: none;">
                        <div class="row">
                            <div class="col text-center">
                                @include('shared.misc.loading-spinner')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    <script src='{{ asset('js/vote.js') }}'></script>
@endsection
