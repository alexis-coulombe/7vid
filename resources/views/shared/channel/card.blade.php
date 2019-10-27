@php if(isset($author)) $channel = $author; @endphp
@php $authorId = $channel->id @endphp

<div class="channels-card">
    <div class="channels-card-image">
        <a href="{{ route('channel.index', ['id' => $channel->id]) }}">
            <img src="{{ $channel->avatar }}">
        </a>
        @if(Auth::check())
            @include('shared.video.subscribe')
        @endif
    </div>
    <div class="channels-card-body">
        <div class="channels-title">
            <a href="{{ route('channel.index', ['id' => $channel->id]) }}" aria-label="View channel">{{ $channel->name }}</a>
        </div>
    </div>
</div>