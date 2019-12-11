<ul class="sidebar navbar-nav toggled">
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <small>
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Create an account / Login</span>
                </small>
            </a>
        </li>
    @endguest
    <li class="nav-item separator {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    @auth
            <li class="nav-item {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home.history' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home.history') }}">
                    <i class="fas fa-book-open"></i>
                    <span>Your history</span>
                </a>
            </li>
            <li class="nav-item {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home.liked' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home.liked') }}">
                    <i class="fas fa-heart"></i>
                    <span>Videos you liked</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-columns"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @php $subscriptions = Auth::user()->subscriptions; @endphp
        @if(count($subscriptions) > 0)
            <li class="nav-item channel-sidebar-list">
                <h6>SUBSCRIPTIONS</h6>
                <ul>
                    @foreach($subscriptions as $subscription)
                        <li>
                            <a href="{{ route('channel.index', ['userId' => $subscription->channel->id]) }}">
                                <img class="img-fluid" alt="" src="{{ getImage(route('cdn.img.avatar'), $subscription->channel->avatar) }}">
                                {{ $subscription->channel->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endauth
</ul>
