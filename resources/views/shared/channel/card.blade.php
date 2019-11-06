@php if(isset($author)) $channel = $author; @endphp

<a href="{{ route('channel.index', ['id' => $channel->id]) }}">
    <div class="channels-card">
        <div class="channels-card-image">
            <img src="{{ $channel->avatar }}" alt="Avatar">
            @if(Auth::check() && Auth::id() !== $channel->id)
                @include('shared.video.subscribe')
            @endif
        </div>
        <div class="channels-card-body">
            <div class="channels-title">
                <p aria-label="{{ $channel->name }}">{{ $channel->name }}</p>
            </div>
        </div>
    </div>
</a>
