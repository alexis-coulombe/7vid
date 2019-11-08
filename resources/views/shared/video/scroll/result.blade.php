@foreach($channels as $channel)
    <hr>
    <div class="video-block section-padding scrolling-result" id="{{ $channel->id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <h6>{{ $channel->name }} <b></b> - <a href="{{ route('channel.index', ['userId' => $channel->id]) }}">View videos</a></h6>
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
