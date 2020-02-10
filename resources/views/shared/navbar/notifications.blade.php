@php
    $date = new \DateTime();
    $date->modify('-1 week');
    $formatted_date = $date->format('Y-m-d H:i:s');

    $notifications = Auth::user()->notifications()->where('created_at', '>',$formatted_date)->limit(5)->get();
@endphp

<a class="nav-link dropdown-toggle" aria-label="dropdown" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    @if(count($notifications) > 0)
        <span class="badge badge-danger">{{ count($notifications) }}</span>
    @endif
</a>

<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
    @if(count($notifications) > 0)
        @foreach($notifications as $notification)
            @php $notification = json_decode($notification->data['data'], true, 512, JSON_THROW_ON_ERROR); @endphp
            <div class="dropdown-item">
                <button class="btn btn-sm btn-primary">Hide</button>
                <a href="{{ isset($notification['link']) ? $notification['link'] : '#' }}" class="text-white">{!! $notification['desc'] !!}</a>
            </div>
        @endforeach
    @else
        <div class="text-center mt-3 text-white">
            <p>Nothing to see here !</p>
        </div>
    @endif
</div>
