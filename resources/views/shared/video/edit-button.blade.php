@if(Auth::check() && $video->author->id === Auth::id())
    <div class="float-right video-setting-button">
        <a href="{{ route('video.edit', ['id' => $video->id]) }}"><i class="fas fa-cog"></i></a>
    </div>
@endif
