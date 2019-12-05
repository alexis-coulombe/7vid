@php if(isset($author)) { $channel = $author; } @endphp

<div class="channels-card">
    <div class="channels-card-image">
        <a href="{{ route('channel.index', ['userId' => $channel->id]) }}">
            <img src="{{ route('cdn.img.avatar', ['path' => $channel->avatar]) }}" alt="Avatar">
        </a>
        @if(Auth::check() && Auth::id() !== $channel->id)
            @include('shared.video.subscribe')
        @endif
    </div>
    <div class="channels-card-body">
        <div class="channels-title">
            <a href="{{ route('channel.index', ['userId' => $channel->id]) }}">
                <p aria-label="{{ $channel->name }}">{{ $channel->name }}</p>
            </a>
        </div>
    </div>
</div>

