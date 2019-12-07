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
                    <h1 class="h2 col-lg-12">About {{ $author->name }}</h1>
                    <hr>
                    <p class="text-justify col-lg-6">
                        Prepare for the Recruitment drive of product
                        based companies like Microsoft, Amazon, Adobe
                        etc with a free online placement preparation
                        course. The course focuses on various MCQ's
                        & Coding question likely to be asked in the
                        interviews & make your upcoming placement
                        season efficient and successful.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
