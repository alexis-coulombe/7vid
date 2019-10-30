@php if(isset($video)) $authorId = $video->author->id; @endphp
@php if(isset($author)) $authorId = $author->id; @endphp

<form action="{{ route('video.subscribe') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="author_id" value="{{ $authorId }}">
    <button class="btn btn-outline-danger btn-sm" type="submit">Subscribe | <strong>{{ \App\Subscription::getSubscriptionCount($authorId) }}</strong></button>
</form>
