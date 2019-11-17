@extends('shared.template')

@section('content')
<div class="box">
    <div class="box__ghost">
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>
        <div class="symbol"></div>

        <div class="box__ghost-container">
            <div class="box__ghost-eyes">
                <div class="box__eye-left"></div>
                <div class="box__eye-right"></div>
            </div>
            <div class="box__ghost-bottom">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="box__ghost-shadow"></div>
    </div>

    <div class="box__description">
        <div class="box__description-container">
            <div class="box__description-title">Whoops!</div>
            <div class="box__description-text">It seems like we couldn't find the page you were looking for</div>
        </div>
        <a href="{{ route('home') }}" class="box__button">Come back</a>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $('footer').hide();
        $('.container-fluid').removeClass();

        let pageX = $(document).width();
        let pageY = $(document).height();
        let mouseY=0;
        let mouseX=0;

        $(document).mousemove(function( event ) {
            mouseY = event.pageY;
            let yAxis = (pageY-mouseY)/pageY*300;
            mouseX = event.pageX / -pageX;
            let xAxis = -mouseX * 100 - $(window).height() / 6;

            $('.box__ghost-eyes').css({ 'transform': 'translate('+ xAxis/2 +'%,-'+ yAxis/2 +'%)' });
        });
    </script>
@endsection
