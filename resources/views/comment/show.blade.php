@foreach($comments as $comment)
    @php
        $upVotes = $comment->getUpVotes();
        $downVotes = $comment->getDownVotes();
        $total = $upVotes + $downVotes;
    @endphp
    <div class="single-video-author box mb-2 scrolling-prevent" id="{{ $comment->getId() }}">
        <div class="float-right" style="margin-left: 10px;">
            @if(Auth::check() && Auth::id() === $comment->getAuthorId())
                <button type="button" class="btn btn-sm text-white float-right" onclick="$('#destroy-form-{{ $comment->getId() }}').submit()">
                    <i class="trash fas fa-trash-alt"></i>
                </button>
            @endif

            @if(Auth::check() && Auth::user()->getId() !== $comment->getAuthorId())
                <button type="button" class="btn btn-sm btn-{{ $comment->userHasVoted(1) ? 'danger' : 'primary' }} vote" data-value="1" data-id="{{ $comment->getId() }}" @auth data-url="{{ route('comment.vote') }}" @endauth>
                    <i class="fas fa-thumbs-up"></i>
                </button>
                <button type="button" class="btn btn-sm btn-{{ $comment->userHasVoted(0) ? 'danger' : 'primary' }} vote" data-value="0" data-id="{{ $comment->getId() }}" @auth data-url="{{ route('comment.vote') }}" @endauth>
                    <i class="fas fa-thumbs-down"></i>
                </button>
            @endif

            @include('shared.vote.progress')
        </div>
        <div class="row vertical-center mb-2">
            <a href="{{ route('channel.index', ['userId' => $comment->getAuthorId()]) }}">
                <img class="img-fluid" loading="lazy" width="38px" height="38px" src="{{ getImage(route('cdn.img.avatar'), $comment->author->getAvatar()) }}" alt="{{ $comment->author->getName() }}" alt="Avatar">
            </a>
            <p class="ml-2">
                <a href="{{ route('channel.index', ['userId' => $comment->getAuthorId()]) }}">
                    <strong>{{ $comment->author->getName() }}</strong>
                </a>
            </p>
        </div>
        <div class="ml-15">
            <p>{{ $comment->getBody() }}</p>
            <small>Published on {{date('Y-m-d', strtotime($comment->created_at))}}</small>
        </div>
    </div>

    @if(Auth::check() && Auth::user()->getId() === $comment->getAuthorId())
        <form action="{{ route('comment.destroy', ['comment' => $comment->getId()]) }}" method="POST" id="destroy-form-{{ $comment->getId() }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    @endif
@endforeach
