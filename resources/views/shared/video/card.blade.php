<div class="video-card">
    <div class="video-card-image">
        <a class="play-icon" aria-label="Play video" href="{{ route('video.show', ['video' => $video->getId()]) }}">
            <i class="fas fa-play-circle"></i>
        </a>
        <a href="{{ route('video.show', ['video' => $video->getId()]) }}" aria-label="View video">
            <img class="lazyload img-fluid" loading="lazy" width="600px" height="300px" data-src="{{ getImage(route('cdn.img'), $video->getThumbnail(), ['q' => '90', 'w' => '600', 'h' => '300']) }}" alt="Video thumbnail">
        </a>
        <div class="time">{{ parseVideoDuration($video->getDuration()) }}</div>
    </div>
    <div class="video-card-body">
        <div class="video-title">
            <a href="{{ route('video.show', ['video' => $video->getId()]) }}" aria-label="{{ $video->getFormatedTitle(50) }}">
                <h3 class="h3">{{ $video->getFormatedTitle(50) }}</h3>
            </a>
        </div>
        <div class="video-page">
            By <a href="{{ route('channel.index', ['userId' => $video->author()->first()->getId()]) }}" aria-label="{{ $video->author()->first()->getName() }}">{{ $video->author()->first()->getName() }}</a>
        </div>
        <div class="video-view">
            <i class="fas fa-eye"></i> {{ $video->getFormatedViewsCount() }} - <i class="far fa-clock"></i> {{ time_elapsed_string($video->created_at) }}
        </div>
    </div>
</div>
