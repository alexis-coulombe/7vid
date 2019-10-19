@foreach($comments as $comment)
    @php
        /** @var \App\User $author */
        $author = \App\User::find($comment->author_id);
    @endphp
    <div class="single-video-author box mb-3">
        <div class="float-right">
            <span><i class="fas fa-trash-alt" onclick="document.getElementById('destroy-form').submit()"></i></span>
        </div>
        <img class="img-fluid" src="img/s4.png" alt="">
        <p><a href="{{ route('channel.index', ['userId' => $author->id]) }}"><strong>{{ $author->name }}</strong></a> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></p>
        <p>{{ $comment->body }}</p>
        <small>Published on {{date('Y-m-d', strtotime($video->created_at))}}</small>
    </div>
    {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'id' => 'destroy-form']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    {!! Form::close() !!}
@endforeach