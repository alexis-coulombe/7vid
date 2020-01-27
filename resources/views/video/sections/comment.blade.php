@include('comment.comment-form', $data = ['video_id' => $video->getId()])

@if($comments->count() > 0)
    <div class="row">
        <div class="col-lg-12 mb-1">
            @include('shared.comment.filter')
        </div>
    </div>
@endif

@include('comment.show', $data = ['comments' => $comments])

<div id="scrolling" data-url="{{ route('home.scroll') }}" data-type="comment" data-video-id="{{ $video->getId() }}"></div>
<div class="d-none" id="loading-spinner">
    <div class="row">
        <div class="col text-center">
            @include('shared.misc.loading-spinner')
        </div>
    </div>
</div>
