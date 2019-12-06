<a class="nav-link dropdown-toggle" aria-label="dropdown" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    @if(count(Auth::user()->notifications) > 0)
        <span class="badge badge-danger">{{ count(Auth::user()->notifications) }}</span>
    @endif
</a>

@php
    $notifications = Auth::user()->notifications()->limit(5)->get();
@endphp

<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
    @foreach($notifications as $notification)
        @php $notification = json_decode($notification->data['data']) @endphp
        <div class="dropdown-item">
            <button class="btn btn-sm btn-primary">Hide</button>
            <a href="{{ isset($notification->link) ?? '#' }}">{{ $notification->desc }}</a>
        </div>
    @endforeach
    <div class="dropdown-divider"></div>
    <div class="dropdown-item">
        <a href="#">See more</a>
    </div>
</div>
