<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('dashboard.index') }}" class="simple-text logo-normal">
            Your dashboard
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    <p>Back to 7-vid</p>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
        </ul>
    </div>
</div>
