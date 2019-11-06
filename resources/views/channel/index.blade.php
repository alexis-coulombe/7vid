@extends('shared.template')

@section('title')
    channel of {{ $author->name }}
@endsection

@section('content')
    <div class="single-channel-page">
        <div class="single-channel-image">
            <img class="img-fluid" alt="" src="{{ asset('assets/img/channel-banner.png') }}">
            <div class="channel-profile">
                <img class="channel-profile-img" alt="" src="/{{ $author->avatar }}">
                @if(Auth::check() && Auth::id() === $author->id)
                    <div class="social hidden-xs">
                        <a href="#">Edit channel page</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="single-channel-nav">
            @include('shared.channel.navbar')
        </div>
        <div class="container-fluid">
            <div class="video-block section-padding">
                <div class="row">
                    @if(count($author->videos) > 0)
                        <div class="col-md-12">
                            <div class="main-title">
                                <div class="btn-group float-right right-action">
                                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                    </div>
                                </div>
                                <h6>Videos</h6>
                            </div>
                        </div>
                        @foreach($author->videos as $video)
                            <div class="col-xl-3 col-sm-6 mb-3">
                                @include('shared.video.card')
                            </div>
                        @endforeach
                    @else
                        <div class="col-sm-1 col-md-2"></div>
                        <div class="col-sm-3 col-md-3">
                            <svg width="380px" height="500px" viewBox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="#FF0000" stroke-width="6" sketch:type="MSShapeGroup"></path>
                                    <path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#FF6161" stroke-width="6" sketch:type="MSShapeGroup"></path>
                                    <path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#AB2020" stroke-width="6" sketch:type="MSShapeGroup"></path>
                                    <path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#D69696" stroke-width="6" sketch:type="MSShapeGroup"></path>
                                    <path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#FF4747" stroke-width="6" sketch:type="MSShapeGroup"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="col-sm-7 col-md-7">
                            <h2>Empty !</h2>
                            <p>This author does not have any content !</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
