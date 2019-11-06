<div class="video-card">
    <div class="video-card-image">
        <a class="play-icon" aria-label="Play video" href="{{ route('video.show', ['video' => $video->id]) }}">
            <i class="fas fa-play-circle"></i>
        </a>
        <a href="{{ route('video.show', ['video' => $video->id]) }}" aria-label="View video">
            <img class="img-fluid" loading="lazy" src="/{{ $video->thumbnail }}" alt="Video thumbnail">
        </a>
        <div class="time">{{ gmdate("H:i:s",$video->duration) }}</div>
    </div>
    <div class="video-card-body">
        <div class="video-title">
            <a href="{{ route('video.show', ['video' => $video->id]) }}" aria-label="{{strlen($video->title) > 50 ? substr($video->title,0,50)."..." : $video->title}}">
                <h3 class="h4">{{strlen($video->title) > 50 ? substr($video->title,0,50)."..." : $video->title}}</h3>
            </a>
            @include('shared.video.edit-button')
            @include('shared.video.delete-button')
        </div>
        <div class="video-page">
            By <u><a href="{{ route('channel.index', ['userId' => $video->author->ìd]) }}" aria-label="{{ $video->author->name }}">{{ $video->author->name }}</a></u>
        </div>
        <div class="video-view">
            <i class="fas fa-eye"></i> {{ $video->getFormatedViewsCount() }} - <i class="far fa-clock"></i> {{ time_elapsed_string($video->created_at) }}
        </div>
    </div>
</div>
