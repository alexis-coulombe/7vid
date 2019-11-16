@foreach($comments as $comment)
    @php
        $upVotes = 0;
        $downVotes = 0;

        foreach($comment->votes as $vote){
            if($vote->value){
                $upVotes++;
            } else {
                $downVotes++;
            }
        }
    @endphp
    <div class="single-video-author box mb-3">
        <div class="float-right">
            {{ $upVotes }}
            {{ $downVotes }}
            <button type="button" class="btn btn-sm btn-{{ \App\CommentVote::hasVoted(1, $comment->id) ? 'danger' : 'primary' }} vote" data-value="1" data-id="{{ $comment->id }}" @if(Auth::check()) data-url="{{ route('comment.vote') }}" @endif><i class="fas fa-thumbs-up"></i></button>
            <button type="button" class="btn btn-sm btn-{{ \App\CommentVote::hasVoted(0, $comment->id) ? 'danger' : 'primary' }} vote" data-value="0" data-id="{{ $comment->id }}" @if(Auth::check()) data-url="{{ route('comment.vote') }}" @endif><i class="fas fa-thumbs-down"></i></button>
            @if($upVotes === $downVotes)
                <div class="progress">
                    <div class="progress-bar" role="progressbar"></div>
                </div>
            @else
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($upVotes / ($upVotes + ($downVotes <= 0 ? 1 : $downVotes)))*100 }}%;"></div>
                </div>
            @endif
            @if(Auth::check() && Auth::id() === $comment->author_id)
                <span><i class="trash fas fa-trash-alt" onclick="document.getElementById('destroy-form').submit()"></i></span>
            @endif
        </div>
        <a href="{{ route('channel.index', ['userId' => $comment->author_id]) }}"><img class="img-fluid" loading="lazy" src="/{{ $comment->author->avatar }}" alt=""></a>
        <p><a href="{{ route('channel.index', ['userId' => $comment->author_id]) }}"><strong>{{ $comment->author->name }}</strong></a> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></p>
        <p>{{ $comment->body }}</p>
        <br>
        <small>Published on {{date('Y-m-d', strtotime($video->created_at))}}</small>
    </div>

    @if(Auth::check() && Auth::id() === $comment->author_id)
        <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" id="destroy-form">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    @endif
@endforeach
