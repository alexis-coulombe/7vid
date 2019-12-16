<div class="row">
    @foreach($videos as $video)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 scrolling-prevent" id="{{ $video->getId() }}">
            @include('shared.video.card')
        </div>
    @endforeach
</div>
