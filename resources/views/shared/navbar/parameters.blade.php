<a class="nav-link dropdown-toggle" aria-label="dropdown" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-cog"></i>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
    <a class="dropdown-item" href="{{ route('channel.index', ['userId' => Auth::id()]) }}"><i class="far fa-newspaper"></i> &nbsp; View your channel</a>
    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-headphones-alt "></i> &nbsp; Another action</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" onclick="$('.logout-form').submit();"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        {{ csrf_field() }}
    </form>
</div>