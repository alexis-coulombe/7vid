<nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
    &nbsp;&nbsp;
    <button aria-label="Minimize sidebar" class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button> &nbsp;&nbsp;
    <a class="navbar-brand mr-1" aria-label="homepage" href="{{ route('home') }}">
        <img class="img-fluid" loading="lazy" alt="logo" width="50px" height="50px" src="{{ asset('assets/img/logo.svg') }}">
    </a>
    <!-- Navbar Search -->
    <form action="{{ route('video.search') }}" method="GET" class="d-none d-md-inline-block form-inline osahan-navbar-search">
        <div class="input-group">
            {{ csrf_field() }}
            <input type="text" name="search" id="search" class="form-control" placeholder="Video id, Author, Category ..." value="{{ request('search') ?? '' }}" required>
            <div class="input-group-append">
                <button class="btn btn-light" aria-label="Search" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0 ">
        @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('video.create') }}" aria-label="Upload video">
                    <i class="fas fa-plus-circle fa-fw"></i>
                </a>
            </li>
            <li class="nav-item dropdown no-arrow">
                @include('shared.navbar.notifications')
            </li>
            <li class="nav-item dropdown no-arrow">
                @include('shared.navbar.parameters')
            </li>
        @endauth
        <li class="nav-item dropdown mr-3">
            @auth
                <a class="nav-link dropdown-toggle user-dropdown-link" href="{{ route('channel.index', ['userId' => Auth::user()->getId()]) }}">
                    <img alt="Avatar" loading="lazy" width="30px" height="30px" src="{{ getImage(route('cdn.img.avatar'), Auth::user()->getAvatar()) }}" alt="Avatar">
                </a>
            @endauth
            @guest
                <a class="nav-link dropdown-toggle user-dropdown-link" aria-label="dropdown" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Create an account / Login
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-fw fa-user-circle"></i> &nbsp; Create an account</a>
                    <a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-fw fa-video"></i> &nbsp; Login</a>
                </div>
            @endguest
        </li>
    </ul>
</nav>
