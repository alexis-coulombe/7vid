@foreach($comments as $comment)
    @php
        $upVotes = $comment->getUpVotes();
        $downVotes = $comment->getDownVotes();
    @endphp
    <div class="single-video-author box mb-3 scrolling-prevent" id="{{ $comment->getId() }}">
        <div class="float-right" style="padding-bottom: 30px; margin-left: 10px;">
            @if(Auth::check() && Auth::id() === $comment->getAuthorId())
                <button type="button" class="btn btn-sm btn-primary" onclick="$('.destroy-form-{{ $comment->getId() }}').submit()">
                    <i class="trash fas fa-trash-alt"></i>
                </button>
            @endif
            <button type="button" class="btn btn-sm btn-{{ $comment->userHasVoted(1) ? 'danger' : 'primary' }} vote" data-value="1" data-id="{{ $comment->getId() }}" @if(Auth::check()) data-url="{{ route('comment.vote') }}" @endif>
                <i class="fas fa-thumbs-up"></i>
            </button>
            <button type="button" class="btn btn-sm btn-{{ $comment->userHasVoted(0) ? 'danger' : 'primary' }} vote" data-value="0" data-id="{{ $comment->getId() }}" @if(Auth::check()) data-url="{{ route('comment.vote') }}" @endif>
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
        <div class="row vertical-center mb-2">
            <a href="{{ route('channel.index', ['userId' => $comment->getAuthorId()]) }}">
                <img class="img-fluid" loading="lazy" src="{{ getImage(route('cdn.img.avatar'), $comment->author->getAvatar()) }}" alt="{{ $comment->author->getName() }}">
            </a>
            <p class="ml-2">
                <a href="{{ route('channel.index', ['userId' => $comment->getAuthorId()]) }}">
                    <strong>{{ $comment->author->getName() }}</strong>
                </a>
            </p>
        </div>
        <p>{{ $comment->getBody() }}</p>
        <br>
        <small>Published on {{date('Y-m-d', strtotime($comment->created_at))}}</small>
    </div>

    @if(Auth::check() && Auth::user()->getId() === $comment->getAuthorId())
        <form action="{{ route('comment.destroy', ['comment' => $comment->getId()]) }}" method="POST" class="destroy-form-{{ $comment->getId() }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    @endif
@endforeach
