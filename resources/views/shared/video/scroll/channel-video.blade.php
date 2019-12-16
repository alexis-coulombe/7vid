@foreach($channels as $channel)
    <hr>
    <div class="video-block section-padding scrolling-prevent" id="{{ $channel->getId() }}">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <h6>{{ $channel->getName() }} <b></b> - <a href="{{ route('channel.index', ['userId' => $channel->getId()]) }}">View videos</a></h6>
                </div>
            </div>
            @foreach($channel->videos as $video)
                <div class="col-sm-12 col-md-4 col-lg-2">
                    @include('shared.video.card')
                </div>
            @endforeach
        </div>
    </div>
@endforeach
