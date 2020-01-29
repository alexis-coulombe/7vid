<div class="single-channel-image">
    <img class="lazyload img-fluid" alt="Banner" data-src="{{ asset('assets/img/channel-banner.png') }}" loading="lazy" width="1900px" height="500px">
    <div class="channel-profile">
        <img class="channel-profile-img" alt="Avatar" loading="lazy" width="90px" height="90px" src="{{ getImage(route('cdn.img.avatar'), $author->getAvatar(), ['q' => '50', 'w' => '90', 'h' => '90']) }}">
    </div>
</div>
