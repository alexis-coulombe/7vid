@php if(isset($video)) { $author = $video->author; } @endphp
@php if(isset($channel)) { $author = $channel; } @endphp

@php
    $subscribeText = Auth::user()->isSubscribed($author->id) ? 'Unsubscribe' : 'Subscribe';
@endphp

<button class="btn btn-danger subscribe" data-id="{{ $author->getId() }}" data-url="{{ route('channel.subscribe') }}">
    <span class="subscribe-text">{{ $subscribeText }}</span> | <strong>{{ $author->getSubscribersCount($author->getId()) }}</strong>
</button>
