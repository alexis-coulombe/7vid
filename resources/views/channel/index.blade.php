@extends('shared.template')

@section('title')
    channel of {{ $author->name }}
@endsection

@section('content')
    <div class="single-channel-page">
        @include('shared.channel.image')

        <div class="single-channel-nav">
            @include('shared.channel.navbar')
        </div>
    </div>
@endsection
