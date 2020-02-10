@php if(isset($author)) { $channel = $author; } @endphp

<div class="channels-card generate-background h-200 mb-2">
    <div class="channels-card-image">
        <a href="{{ route('channel.index', ['userId' => $channel->getId()]) }}">
            <img data-src="{{ getImage(route('cdn.img.avatar'), $channel->getAvatar(), ['q' => '50', 'w' => '80', 'h' => '80']) }}" class="lazyload" loading="lazy" width="80px" height="80px" alt="Avatar">
        </a>
        <br>
        @if((Auth::check() && Auth::user()->getId() !== $channel->getId()) || !Auth::check())
            @include('shared.video.subscribe')
        @endif
    </div>
    <div class="channels-card-body">
        <div class="channels-title">
            <a href="{{ route('channel.index', ['userId' => $channel->getId()]) }}">
                <p aria-label="{{ $channel->getName() }}">{{ $channel->getName() }}</p>
            </a>
        </div>
    </div>
</div>

