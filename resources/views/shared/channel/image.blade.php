<div class="single-channel-image">
    <img class="img-fluid" alt="" src="{{ asset('assets/img/channel-banner.png') }}">
    <div class="channel-profile">
        <img class="channel-profile-img" alt="" src="{{ getImage(route('cdn.img.avatar'), $author->getAvatar()) }}">
        @if(Auth::check() && Auth::user()->getId() === $author->getId())
            <div class="social hidden-xs">
                <a href="{{ route('dashboard.index') }}">Edit channel page</a>
            </div>
        @endif
    </div>
</div>
