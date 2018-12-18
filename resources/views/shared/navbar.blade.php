<!--<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/video/create">+ Share a video</a>
            </li>
        </ul>
        {!! Form::open(['url' => 'video/search', 'class' => 'form-inline my-2 my-lg-0', 'method' => 'GET']) !!}
            {{Form::text('search', '', ['placeholder' => 'Search', 'class' => 'form-control mr-sm-0'])}}
            {{Form::submit('Search', ['class' => 'btn btn-success my-2 my-sm-0'])}}
        {!! Form::close() !!}
        <ul class="navbar-nav mr-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();">
                            Your channel
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>-->

<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/">
                <span>VidMock</span> Video sharing
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a>
                            Menu
                        </a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item p-0">
                    {!! Form::open(['url' => 'video/search', 'class' => 'form-inline my-2 my-lg-0', 'method' => 'GET']) !!}
                    {{Form::text('search', '', ['placeholder' => 'Search', 'class' => 'form-control'])}}
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i>
                    </button>
                    {!! Form::close() !!}
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-cogs d-lg-none d-xl-none"></i> Get started!
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="{{ route('login') }}" class="dropdown-item">
                            <i class="fas fa-sign-in-alt"></i>Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <i class="fas fa-user-plus"></i>Register
                            </a>
                        @endif
                        <a href="examples/landing-page.html" class="dropdown-item">
                            <i class="fas fa-info"></i>About
                        </a>
                        <a href="examples/profile-page.html" class="dropdown-item">
                            <i class="fas fa-code"></i>Dev API
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-default d-none d-lg-block" href="javascript:void(0)" onclick="scrollToDownload()">
                        <i class="tim-icons icon-cloud-download-93"></i> Download
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
