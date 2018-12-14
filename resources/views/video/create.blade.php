@extends('shared.template')

@section('content')
    <style>
        #drop-zone {
            border: 2px dashed rgba(0,0,0,.3);
            border-radius: 20px;
            font-family: Arial;
            text-align: center;
            position: relative;
            line-height: 180px;
            font-size: 20px;
            color: rgba(0,0,0,.3);
        }

        #drop-zone input {
            position: absolute;
            cursor: pointer;
            left: 0px;
            top: 0px;
            opacity:0;
        }

        #drop-zone.mouse-over {
            border: 2px dashed rgba(0,0,0,.5);
            color: rgba(0,0,0,.5);
        }


        #clickHere {
            position: absolute;
            cursor: pointer;
            left: 50%;
            top: 50%;
            margin-left: -50px;
            margin-top: 20px;
            line-height: 26px;
            color: white;
            font-size: 12px;
            width: 100px;
            height: 26px;
            border-radius: 4px;
            background-color: #3b85c3;
        }

        #clickHere:hover {
            background-color: #4499DD;
        }
    </style>

    <div class="container">
        <h1 class="my-4 text-center text-lg-left">Post a video</h1>

        {!! Form::open(array('action' => 'VideosController@store', 'enctype' => 'multipart/form-data')) !!}
            <div class="form-group">
                <div id="drop-zone">
                    <span id="drop-zone-text">Drop files here...</span>
                    <div id="clickHere">
                        or click here..
                        {{Form::file('upload', ['id' => 'file'])}}
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    {{Form::label('title', 'Name your video')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'placeholder', 'id' => 'video-title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'No description provided'])}}
                </div>
                <div class="form-group">
                    {{Form::label('image', 'Add an image for your video')}}
                    {{Form::file('image', ['class' => 'form-control'])}}
                </div>
            </div>
            {{Form::submit('Share!', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>

    <script src="{{URL::asset('js/upload/DragNDrop.js')}}"></script>
@endsection