@php if(isset($video)) { $author = $video->author; } @endphp
@php if(isset($channel)) { $author = $channel; } @endphp

@php
    $subscribeText = 'Subscribe';
    if(Auth::check()){
        $subscribeText = Auth::user()->isSubscribed($author->getID()) ? 'Unsubscribe' : 'Subscribe';
    }
@endphp

@auth
    <button class="btn btn-danger subscribe" data-id="{{ $author->getId() }}" data-url="{{ route('channel.subscribe') }}">
        <span class="subscribe-text">{{ $subscribeText }}</span> | <strong>{{ $author->getSubscribersCount($author->getId()) }}</strong>
    </button>
@endauth

@guest
    <button class="btn btn-danger subscribe" onclick="window.location.href='{{ route('login') }}'">
        <span class="subscribe-text">{{ $subscribeText }}</span> | <strong>{{ $author->getSubscribersCount($author->getId()) }}</strong>
    </button>
@endguest
