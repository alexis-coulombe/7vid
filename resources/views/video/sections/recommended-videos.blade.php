<div class="col-md-12">
    <div class="main-title">
        <h6>Up Next</h6>
    </div>
</div>
@php $temp = $video @endphp
@if(count($relatedVideos) > 0)
    @foreach($relatedVideos as $video)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('shared.video.card')
        </div>
    @endforeach
@endif
@php $video = $temp @endphp
