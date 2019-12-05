<div class="single-channel-image">
    <img class="img-fluid" alt="" src="{{ asset('assets/img/channel-banner.png') }}">
    <div class="channel-profile">
        <img class="channel-profile-img" alt="" src="{{ route('cdn.img.avatar', ['path' => $author->avatar]) }}">
        @if(Auth::check() && Auth::id() === $author->id)
            <div class="social hidden-xs">
                <a href="#">Edit channel page</a>
            </div>
        @endif
    </div>
</div>
