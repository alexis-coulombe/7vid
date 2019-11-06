<div class="single-video-info-content box mb-3">
    <p>Comment that video</p>
    <form action="/comment" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="hidden" name="video_id" value="{{ $video_id }}" required>
            <textarea name="comment" class="form-control" placeholder="Enter your comment" required minlength="1" maxlength="255"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send comment</button>
    </form>
</div>
