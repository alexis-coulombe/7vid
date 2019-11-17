@if(Auth::check() && $video->author->id === Auth::id())
    <button type="button" class="btn btn-primary edit-button" onclick="window.location.href='{{ route('video.edit', ['id' => $video->id]) }}'">
        <i class="fas fa-cog"></i> Edit video settings
    </button>
@endif
