<a class="nav-link dropdown-toggle" aria-label="dropdown" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    @if(count(Auth::user()->notifications) > 0)
        <span class="badge badge-danger">{{ count(Auth::user()->notifications) }}</span>
    @endif
</a>

@php
    $date = new \DateTime();
    $date->modify('-1 week');
    $formatted_date = $date->format('Y-m-d H:i:s');

    $notifications = Auth::user()->notifications()->where('created_at', '>',$formatted_date)->limit(5)->get();
@endphp

@if(count($notifications) < 0)
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
        @foreach($notifications as $notification)
            @php $notification = json_decode($notification->data['data']); @endphp
            <div class="dropdown-item">
                <button class="btn btn-sm btn-primary">Hide</button>
                <a href="{{ isset($notification->link) ?? '#' }}">{{ $notification->desc }}</a>
            </div>
        @endforeach
    </div>
@endif
