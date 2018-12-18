<div class="card">
    <div class="card-header">
        <p>Comments</p>
    </div>
    <div class="card-body">
        @foreach($data['comments'] as $comment)
           @php $author = \App\User::find($comment->author_id); @endphp

            @if(Auth::user()->id == $author->id)

            @endif


            <blockquote>
                <p class="blockquote blockquote-primary">
                    <a><i class="fas fa-trash-alt" onclick="document.getElementById('destroy-form').submit()"></i></a>
                    <br>
                    {{ $comment->body }}
                    <br>
                    <small>
                        <b>- {{$author->name}}</b>
                    </small>
                </p>
            </blockquote>
            {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'id' => 'destroy-form']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {!! Form::close() !!}
        @endforeach
    </div>
</div>