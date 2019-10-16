<div class="card">
    <div class="card-header">
        <p>Comments</p>
    </div>
    <div class="card-body">
        @foreach($comments as $comment)
           @php
               /** @var \App\User $author */
               $author = \App\User::find($comment->author_id);
           @endphp
            <blockquote>
                <p class="blockquote blockquote-primary">
                    @if(Auth::user()->id === $author->id)
                        <span><i class="fas fa-trash-alt" onclick="document.getElementById('destroy-form').submit()"></i></span>
                    @endif
                    <br>
                    {{ $comment->body }}
                    <br>
                    <small>
                        <b>- {{$author->name}}</b>
                    </small>
                </p>
            </blockquote>
            @if(Auth::user()->id === $author->id)
                {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'id' => 'destroy-form']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::close() !!}
            @endif
        @endforeach
    </div>
</div>