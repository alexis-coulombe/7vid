@if(Auth::check() && $video->author->getId() === Auth::user()->getId())
    <button type="button" class="btn btn-primary edit-button" onclick="window.location.href='{{ route('video.edit', ['video' => $video->getId()]) }}'">
        <i class="fas fa-cog"></i> Video settings
    </button>
@endif
