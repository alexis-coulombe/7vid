<ul class="sidebar navbar-nav">
    @if(!Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <small>
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Create an account / Login</span>
                </small>
            </a>
        </li>
    @endif
    <li class="nav-item separator {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home' ? 'active' : '' }}">
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
