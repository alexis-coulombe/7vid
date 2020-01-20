<div class="single-channel-image">
    <img class="img-fluid" alt="Banner" src="{{ asset('assets/img/channel-banner.png') }}" loading="lazy" width="1900px" height="500px">
    <div class="channel-profile">
        <img class="channel-profile-img" alt="Avatar" loading="lazy" width="90px" height="90px" src="{{ getImage(route('cdn.img.avatar'), $author->getAvatar()) }}">
    </div>
</div>
