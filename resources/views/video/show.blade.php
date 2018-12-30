@extends('shared.template')

@section('header')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ URL::asset('css/plyr.css') }}">
@endsection

@section('content')
    <br><br><br>
    @include('shared.message')
    <div class="container">
        <h1>{{$video->title}}</h1>

        <video id="player" class="video-js vjs-default-skin" controls preload="auto" poster="">
            <source src="http://dev.test/{{$video->location}}" type="video/{{$video->extension}}">
            To view this video please enable JavaScript, or consider upgrading to a web browser that supports HTML5 video
        </video>

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-primary" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                            <i class="tim-icons icon-spaceship"></i> Description
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#link2" role="tablist">
                            <i class="tim-icons icon-settings-gear-63"></i> Author
                        </a>
                    </li>
                    <li class="nav-item">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus-square"></i> Follow this user
                        </button>
                    </li>
                    <li class="nav-item ml-auto">
                        @if(Auth::check())
                        <a href="#" onclick="voteup();"><i class="fas fa-thumbs-up" style="margin:20px;@php \App\Http\Controllers\VideosController::hasVoted() ? e('color: #82007d;'): e(''); @endphp"></i></a>
                        @endif
                        <span id="upcount" style="color:#70ff7e">{{\App\Http\Controllers\VideosController::GetVoteByValue(1)}}</span>
                        /
                        <span id="downcount" style="color:#ff7070">{{\App\Http\Controllers\VideosController::GetVoteByValue(0)}}</span>
                        @if(Auth::check())
                        <a href="#" onclick="votedown();"><i class="fas fa-thumbs-down" style="margin:20px;@php !\App\Http\Controllers\VideosController::hasVoted() ? e('color: #82007d;'): e(''); @endphp"></i></a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content tab-space">
                    <div class="tab-pane active" id="link1">
                        <p>Shared by <b>{{ $author->name }}</b> on {{date('Y-m-d', strtotime($video->created_at))}}
                            <br />
                            <br/> {{ $video->description }}</p>
                    </div>
                    <div class="tab-pane" id="link2">
                        <p>About the author:</p>
                        <br>
                        <table class="tg">
                            <tr>
                                <th class="tg-0lax">Name :</th>
                                <th class="tg-0lax">{{ $author->name }}</th>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Email :</td>
                                <td class="tg-0lax">{{ $author->email }}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Joined at :</td>
                                <td class="tg-0lax">{{ date('Y-m-d', strtotime($author->created_at)) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(\Illuminate\Support\Facades\Auth::check())
             @include('comment.comment-form', $data = ['video_id' => $video->id])
        @endif

        @include('comment.show', $data = ['comments' => $comments])
    </div>

    <script src="{{ URL::asset('js/plyr.js') }}"></script>
    <script>const player = new Plyr('#player');</script>
    <script>
        let voteup = function(){
            $('.fa-thumbs-up').css('color', '#82007d');
            $('.fa-thumbs-down').css('color', '#B855F5');

           $.ajax({
                url: '/video/vote',
                type: 'POST',
                data: {_token: '<?php echo csrf_token() ?>', value: 1, video_id: '{{$video->id}}'},
                dataType: 'JSON',
               success: function(){
                   location.reload();
               }
            });


        };

        let votedown = function(){
            $('.fa-thumbs-up').css('color', '#B855F5');
            $('.fa-thumbs-down').css('color', '#82007d');

            $.ajax({
                url: '/video/vote',
                type: 'POST',
                data: {_token: '<?php echo csrf_token() ?>', value: 0, video_id: '{{$video->id}}'},
                dataType: 'JSON',
                success: function(){
                   location.reload();
                }
            });
        };
    </script>
@endsection