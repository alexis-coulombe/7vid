@extends('shared.template')

@section('title')
    about {{ $author->name }}
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
                    <h1 class="h2 col-lg-12">About {{ $author->getName() }}</h1>
                    <hr>
                    <div class="col-lg-6">
                        @if($setting)
                            {!! $setting->getAbout() !!}
                        @else
                            No description provided.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
