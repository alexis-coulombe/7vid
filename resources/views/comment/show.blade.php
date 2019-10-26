@foreach($comments as $comment)
    <div class="single-video-author box mb-3">
        <div class="float-right">
            @if(Auth::check() && Auth::id() === $comment->author_id)
                <span><i class="trash fas fa-trash-alt" onclick="document.getElementById('destroy-form').submit()"></i></span>
            @endif
        </div>
        <img class="img-fluid" loading="lazy" src="img/s4.png" alt="">
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