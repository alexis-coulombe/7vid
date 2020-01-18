@extends('shared.template')

@section('title')
    channel of {{ $author->getName() }}
@endsection

@section('description')
    Channel main page of {{ $author->getName() }}
@endsection

@section('content')
    <div class="single-channel-page">
        @include('shared.channel.image')

        <div class="single-channel-nav">
            @include('shared.channel.navbar')
        </div>
    </div>
@endsection
