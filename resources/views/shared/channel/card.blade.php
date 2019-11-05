@php if(isset($author)) $channel = $author; @endphp

<div class="channels-card">
    <div class="channels-card-image">
        <a href="{{ route('channel.index', ['id' => $channel->id]) }}">
            <img src="{{ $channel->avatar }}" alt="Avatar">
        </a>
        @if(Auth::check() && Auth::id() !== $channel->id)
            @include('shared.video.subscribe')
        @endif
    </div>
    <div class="channels-card-body">
        <div class="channels-title">
            <a href="{{ route('channel.index', ['id' => $channel->id]) }}" aria-label="View channel">{{ $channel->name }}</a>
        </div>
    </div>
</div>
