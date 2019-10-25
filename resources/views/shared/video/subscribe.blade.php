<form action="{{ route('video.subscribe') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="author_id" value="{{ $authorId }}">
    <button class="btn btn-danger" type="submit">Subscribe | <strong>{{ \App\Subscription::getSubscriptionCount($authorId) }}</strong></button>
</form>