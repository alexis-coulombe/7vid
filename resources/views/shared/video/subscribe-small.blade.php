@php if(isset($video)) $author = $video->author->id; @endphp

<form action="{{ route('video.subscribe') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="channel_id" value="{{ $author->id }}" required>
    <button class="btn btn-outline-danger btn-sm" type="submit">Subscribe | <strong>{{ \App\Subscription::getSubscriptionCount($author->id) }}</strong></button>
</form>
