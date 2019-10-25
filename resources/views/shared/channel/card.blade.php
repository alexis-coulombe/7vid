@php if(isset($author)) $channel = $author; @endphp
@php $authorId = $channel->id @endphp

<div class="channels-card">
    <div class="channels-card-image">
        @if(Auth::check())
            <div class="channels-card-image">
                @include('shared.video.subscribe')
            </div>
        @endif
    </div>
    <div class="channels-card-body">
        <div class="channels-title">
            <a href="{{ route('channel.index', ['id' => $channel->id]) }}">{{ $channel->name }}</a>
        </div>
    </div>
</div>