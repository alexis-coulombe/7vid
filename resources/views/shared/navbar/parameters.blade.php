<a class="nav-link dropdown-toggle" aria-label="dropdown" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-cog"></i>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
    <a class="dropdown-item" href="{{ route('home.settings') }}"><i class="fas fa-fw fa-cogs"></i> &nbsp; Your settings</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" onclick="$('.logout-form').submit();"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        {{ csrf_field() }}
    </form>
</div>
