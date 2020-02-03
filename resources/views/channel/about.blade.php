@extends('shared.template')

@section('title')
    about {{ $author->getName() }}
@endsection

@section('description')
    {{ $setting ? $setting->getAbout() : 'No description provided about' . $author->getName() }}
@endsection

@section('content')
    <div class="single-channel-page">
        @include('shared.channel.image')

        <div class="single-channel-nav">
            @include('shared.channel.navbar')
        </div>
        <div class="container-fluid">
            <div class="video-block section-padding">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="single-video-title box mb-3">
                            <h1 class="h2">About {{ $author->getName() }}</h1>
                            @auth
                                @if($author->getId() === Auth::user()->getId())
                                    <p class="mb-0">
                                        <i class="fas fa-edit"></i> <a href="#" data-toggle="modal" data-target="#editAboutModal">Edit your description</a>
                                    </p>
                                @endif
                            @endauth
                            <hr>
                            <p>
                                @if($setting && $setting->getAbout())
                                    {!! $setting->getAbout() !!}
                                @else
                                    No description provided.
                                @endif
                            </p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog" aria-labelledby="editAboutModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit your description</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form" id="form">
                        {{ csrf_field() }}
                        <textarea name="about" id="editor" class="col-lg-12">{{ $setting ? $setting->getAbout() : 'No description provided.' }}</textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit" data-dismiss="modal" onclick="$('#form').submit();">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
