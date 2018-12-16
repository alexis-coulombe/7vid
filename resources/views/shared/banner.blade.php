<style>
    header {
        position: relative;
        background-color: black;
        height: 50vh;
        min-height: 25rem;
        width: 100%;
        overflow: hidden;
    }

    header video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        -ms-transform: translateX(-50%) translateY(-50%);
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }

    header .container {
        position: relative;
        z-index: 2;
    }

    header .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: black;
        opacity: 0.5;
        z-index: 1;
    }
</style>

<header>
    <div class="overlay"></div>
    <video id="banner-video" preload="true" autoplay="autoplay" loop="loop" volume="0" poster="banner/img/banner.jpg">
        <source src="banner/banner.mp4" type="video/mp4">
    </video>
    <div class="container h-100">
        <div class="d-flex text-center h-100">
            <div class="my-auto w-100 text-white">
                <h1 class="display-3">Share your video</h1>
                <h2>Insert another line here</h2>
            </div>
        </div>
    </div>
</header>