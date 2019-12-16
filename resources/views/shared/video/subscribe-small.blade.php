@php if(isset($video)) { $author = $video->author->id; } @endphp

@php
    $subscribeText = Auth::user()->isSubscribed($author->getId()) ? 'Unsubscribe' : 'Subscribe';
@endphp

<button class="btn btn-outline-danger btn-sm subscribe" data-id="{{ $author->id }}" data-url="{{ route('channel.subscribe') }}">
    <span class="subscribe-text">{{ $subscribeText }}</span> | <strong class="subscriber-count">{{ $author->getSubscriptionCount($author->id) }}</strong>
</button>
