@foreach($channels as $channel)
    <hr>
    <div class="video-block section-padding scrolling-prevent" id="{{ $channel->getId() }}">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="main-title">
                    <h6>{{ $channel->getName() }} - <a href="{{ route('channel.index', ['userId' => $channel->getId()]) }}">View videos</a></h6>
                </div>
            </div>
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    @foreach($channel->videos as $video)
                        @if($video->setting()->first()->getPrivate() === false)
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                @include('shared.video.card')
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach
