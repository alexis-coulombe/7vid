<nav class="navbar navbar-expand-lg navbar-light">
    <a class="channel-brand" href="#">
        <h1 class="h4">{{ $author->name }}</h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Main page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
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
        <form action="{{ route('video.subscribe') }}" method="POST" class="form-inline my-2 my-lg-0">
            <input class="form-control form-control-sm mr-sm-1" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">
                <i class="fas fa-search"></i>
            </button> &nbsp;&nbsp;&nbsp;
            @if(Auth::check() && $author->id !== Auth::id())
                @include('shared.video.subscribe-small')
            @endif
        </form>
    </div>
</nav>
