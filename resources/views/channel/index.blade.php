@extends('shared.template')

@section('title')
    channel of {{ $author->name }}
@endsection

@section('content')
    <div class="single-channel-page">
        @include('shared.channel.image')

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
                        Index page todo CMS
                    @else
                        <div class="col-sm-3 col-md-3">
                            <h2>Empty !</h2>
                            <p>This author does not have any content !</p>
                        </div>
                        @include('shared.misc.floating-hex')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
