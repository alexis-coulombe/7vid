<div class="card">
    <div class="card-header">
        <p>Comment that video</p>
    </div>
    <div class="card-body">
        {!! Form::open(array('action' => 'CommentsController@store')) !!}
        @csrf
        <div class="form-group">
            {{Form::hidden('video_id', $data['video_id'])}}
            {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Enter your comment'])}}
        </div>
        {{Form::submit('Comment', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
</div>