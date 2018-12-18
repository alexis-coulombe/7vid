<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1 class="title">Design by <a href="#">BLK•</a></h1>
            </div>
            <div class="col-md-3">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            Login
                        </a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            Register
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>