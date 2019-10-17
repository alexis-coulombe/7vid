<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('home') }}">
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
                    {!! Form::open(['url' => '/', 'class' => 'form-inline my-2 my-lg-0', 'method' => 'GET', 'id' => 'filter-form']) !!}
                    <select class="form-control" name="category" style="background:#1D1F43">
                        <option value="" @php echo(request()->get('category') != null ? '' : 'selected'); @endphp disabled>Choose here</option>
                        @foreach(\App\Category::all() as $c)
                            <option value="{{$c->id}}" @php echo(request()->get('category') == $c->id ? 'selected' : ''); @endphp>{{$c->title}}</option>
                        @endforeach
                    </select>
                    {{Form::text('search', request()->get('search'), ['placeholder' => 'Search', 'class' => 'form-control'])}}
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i>
                    </button>
                    {!! Form::close() !!}
                </li>
                @if (Auth::check())
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="fa fa-cogs d-lg-none d-xl-none"></i> Account
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="{{ route('channel.index', ['userId' => Auth::id()]) }}" class="dropdown-item">
                                <i class="fa fa-video-camera"></i>View your channel
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="examples/landing-page.html" class="dropdown-item">
                                <i class="fas fa-info"></i>About
                            </a>
                            <a href="examples/profile-page.html" class="dropdown-item">
                                <i class="fas fa-code"></i>Dev API
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('video.create') }}/video/create">+ Share a video</a>
                    </li>
                @else
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
                @endif
            </ul>
        </div>
    </div>
</nav>
