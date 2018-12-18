@extends('shared.template')

@section('header')
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
                    <div class="tab-pane" id="link3">
                        <p>Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
                            <br />
                            <br/> Dramatically maintain clicks-and-mortar solutions without functional solutions.</p>
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
@endsection