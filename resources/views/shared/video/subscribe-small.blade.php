@php if(isset($video)) $author = $video->author->id; @endphp

@php
    $subText = Auth::user()->isSubscribed(Route::current()->parameters()['userId']) ? 'Unsubscribe' : 'Subscribe';
@endphp

<form action="{{ route('video.subscribe') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="author_id" value="{{ $author->id }}">
    <button class="btn btn-outline-danger btn-sm" type="submit">{{ $subText }} | <strong>{{ \App\Subscription::getSubscriptionCount($author->id) }}</strong></button>
</form>
