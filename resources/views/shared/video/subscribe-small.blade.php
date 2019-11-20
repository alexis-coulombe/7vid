@php if(isset($video)) $author = $video->author->id; @endphp

@php
    $subscribeText = Auth::user()->isSubscribed($author->id) ? 'Unsubscribe' : 'Subscribe';
@endphp

<button class="btn btn-outline-danger btn-sm subscribe" data-id="{{ $author->id }}" data-url="{{ route('channel.subscribe') }}">
    <span class="subscribe-text">{{ $subscribeText }}</span> | <strong>{{ \App\Subscription::getSubscriptionCount($author->id) }}</strong>
</button>
