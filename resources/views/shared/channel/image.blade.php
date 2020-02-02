<div class="single-channel-image">
    @if($author->setting()->first()->getBackgroundImage())
        <img class="lazyload img-fluid" alt="Banner" data-src="{{ getImage(route('cdn.img'), $author->setting()->first()->getBackgroundImage()) }}" loading="lazy" width="1900px" height="500px">
    @endif
    <div class="channel-profile">
        <img class="channel-profile-img" alt="Avatar" loading="lazy" width="90px" height="90px" src="{{ getImage(route('cdn.img.avatar'), $author->getAvatar(), ['q' => '60', 'w' => '90', 'h' => '90']) }}">
    </div>
</div>
