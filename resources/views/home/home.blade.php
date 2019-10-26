@extends('shared.template')

@section('content')
    <div class="top-mobile-search">
        <div class="row">
            <div class="col-md-12">
                <form class="mobile-search">
                    <div class="input-group">
                        <input type="text" placeholder="Search for..." class="form-control">
                        <div class="input-group-append">
                            <button type="button" aria-label="Search" class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="top-category section-padding mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" aria-label="filter" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>Channels Categories</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-carousel-category">
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s1.png" alt="">
                                <h6>Your Life</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s2.png" alt="">
                                <h6>Unboxing Cool</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s3.png" alt="">
                                <h6>Service Reviewing</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s4.png" alt="">
                                <h6>Gaming <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s5.png" alt="">
                                <h6>Technology Tutorials</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s6.png" alt="">
                                <h6>Singing</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s7.png" alt="">
                                <h6>Cooking</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s8.png" alt="">
                                <h6>Traveling</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s1.png" alt="">
                                <h6>Education</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s2.png" alt="">
                                <h6>Noodles, Sauces & Instant Food</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s3.png" alt="">
                                <h6>Comedy <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/s4.png" alt="">
                                <h6>Lifestyle Advice</h6>
                                <p>74,853 views</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <h6>Recently uploaded</h6>
                </div>
            </div>
            @if(count($newVideos) > 0)
                <div class="owl-carousel owl-carousel-video-card">
                    @foreach($newVideos as $video)
                        <div class="item">
                            @include('shared.video.card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <hr class="mt-0">
    <div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" aria-label="filter" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>4 random channels</h6>
                </div>
            </div>
            @if(count($newChannels) > 0)
                @foreach($newChannels as $channel)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.channel.card')
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
