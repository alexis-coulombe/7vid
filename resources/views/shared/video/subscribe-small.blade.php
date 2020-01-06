@php if(isset($video)) { $author = $video->author->id; } @endphp

@php
    $subscribeText = 'Subscribe';
    if(Auth::check()){
        $subscribeText = Auth::user()->isSubscribed($author->getID()) ? 'Unsubscribe' : 'Subscribe';
    }
@endphp

@auth
    <button class="btn btn-outline-danger btn-sm subscribe" data-id="{{ $author->id }}" data-url="{{ route('channel.subscribe') }}">
        <span class="subscribe-text">{{ $subscribeText }}</span> | <strong class="subscriber-count">{{ $author->getSubscriptionCount($author->id) }}</strong>
    </button>
@endauth

@guest
    <button class="btn btn-outline-danger btn-sm subscribe" onclick="window.location.href='{{ route('login') }}'">
        <span class="subscribe-text">{{ $subscribeText }}</span> | <strong class="subscriber-count">{{ $author->getSubscriptionCount($author->id) }}</strong>
    </button>
@endguest
