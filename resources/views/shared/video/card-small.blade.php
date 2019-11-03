<div class="video-card video-card-list">
    <div class="video-card-image">
        <a class="play-icon" aria-label="Play video" href="{{ route('video.show', ['video' => $video->id]) }}"><i class="fas fa-play-circle"></i></a>
        <a href="{{ route('video.show', ['video' => $video->id]) }}" aria-label="View video"><img class="img-fluid" loading="lazy" src="/{{ $video->thumbnail }}" alt=""></a>
        <div class="time">{{ gmdate("H:i:s",$video->duration) }}</div>
    </div>
    <div class="video-card-body">
        <div class="btn-group float-right right-action">
            <a href="{{ route('video.show', ['video' => $video->id]) }}" aria-label="View video" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
            </div>
        </div>
        <div class="video-title">
            <a href="{{ route('video.show', ['video' => $video->id]) }}" aria-label="View video">{{strlen($video->title) > 30 ? substr($video->title,0,30)."..." : $video->title}}</a>
        </div>
        <div class="video-page text-success">
            {{ $video->category->title }}
        </div>
        <div class="video-view">
            {{ $video->getFormatedViewsCount() }} views <br>
        </div>
    </div>
</div>
