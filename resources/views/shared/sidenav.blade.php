<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    @if(Auth::check())
        @php $subscriptions = Auth::user()->subscriptions; @endphp
        @if(count($subscriptions) > 0)
            <li class="nav-item channel-sidebar-list">
                <h6>SUBSCRIPTIONS</h6>
                <ul>
                    @foreach($subscriptions as $subscription)
                        <li>
                            <a href="{{ route('channel.index', ['userId' => $subscription->channel->id]) }}">
                                <img class="img-fluid" alt="" src="/{{ $subscription->channel->avatar }}"> {{ $subscription->channel->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endif
</ul>
