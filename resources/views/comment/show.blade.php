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
    <div class="single-video-author box mb-3 scrolling-prevent" id="{{ $comment->id }}">
        <div class="float-right" style="padding-bottom: 30px; margin-left: 10px;">
            @if(Auth::check() && Auth::id() === $comment->author_id)
                <button type="button" class="btn btn-sm btn-primary" onclick="$('.destroy-form-{{ $comment->id }}').submit()">
                    <i class="trash fas fa-trash-alt"></i>
                </button>
            @endif
            <button type="button" class="btn btn-sm btn-{{ \App\CommentVote::hasVoted(1, $comment->id) ? 'danger' : 'primary' }} vote" data-value="1" data-id="{{ $comment->id }}" @if(Auth::check()) data-url="{{ route('comment.vote') }}" @endif>
                <i class="fas fa-thumbs-up"></i>
            </button>
            <button type="button" class="btn btn-sm btn-{{ \App\CommentVote::hasVoted(0, $comment->id) ? 'danger' : 'primary' }} vote" data-value="0" data-id="{{ $comment->id }}" @if(Auth::check()) data-url="{{ route('comment.vote') }}" @endif>
                <i class="fas fa-thumbs-down"></i>
            </button>
            @if($upVotes === $downVotes)
                <div class="progress">
                    <div class="progress-bar" role="progressbar"></div>
                </div>
            @else
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($upVotes / ($upVotes + ($downVotes <= 0 ? 1 : $downVotes)))*100 }}%;"></div>
                </div>
            @endif
        </div>
        <a href="{{ route('channel.index', ['userId' => $comment->author_id]) }}">
            <img class="img-fluid" loading="lazy" src="/{{ $comment->author->avatar }}" alt="{{ $comment->author->name }}">
        </a>
        <p>
            <a href="{{ route('channel.index', ['userId' => $comment->author_id]) }}">
                <strong>{{ $comment->author->name }}</strong>
            </a>
            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span>
        </p>
        <p>{{ $comment->body }}</p>
        <br>
        <small>Published on {{date('Y-m-d', strtotime($comment->created_at))}}</small>
    </div>

    @if(Auth::check() && Auth::id() === $comment->author_id)
        <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" class="destroy-form-{{ $comment->id }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    @endif
@endforeach
