<nav class="navbar navbar-expand-lg navbar-light">
    <a class="channel-brand" href="#">
        <h1 class="h4">{{ $author->getName() }}</h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'channel.videos' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('channel.videos', ['userId' => $author->getId()]) }}">Videos</a>
            </li>
            <li class="nav-item {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'channel.about' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('channel.about', ['userId' => $author->getId()]) }}">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Donate
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <input class="form-control form-control-sm mr-sm-1" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">
                <i class="fas fa-search"></i>
            </button> &nbsp;&nbsp;&nbsp;
            @if(Auth::check() && $author->getId() !== Auth::user()->getId())
                @include('shared.video.subscribe-small')
            @endif
        </div>
    </div>
</nav>
