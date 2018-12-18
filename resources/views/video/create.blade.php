@extends('shared.template')

@section('body-class')
    "landing-page"
@endsection

@section('content')
    <br><br><br>
    <div class="container">
        @include('shared.message')
        <h1 class="my-4 text-center text-lg-left">Post a video</h1>

        {!! Form::open(array('action' => 'VideosController@store', 'enctype' => 'multipart/form-data')) !!}

            {{Form::label('image', 'Select a video to upload')}}

            {{Form::file('upload', ['id' => 'file', 'class' => 'form-control-file'])}}
                <hr>
                <div class="form-group">
                    {{Form::label('title', 'Name your video')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => '', 'id' => 'video-title'])}}
                </div>
                <br>

                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'No description provided'])}}
                </div>
                <br>

            {{Form::label('image', 'Add an image for your video')}}<br>
            {{Form::file('image', ['id' => 'image'])}}
                <br><br>
            {{Form::submit('Share!', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
    <br>
@endsection