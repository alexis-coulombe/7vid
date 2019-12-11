@extends('shared.template')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#buttons">Buttons</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#alerts">Alerts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cards">Cards</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="buttons" class="tab-pane fade in active">
            <!-- Buttons -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Buttons</h3>
                    <button type="button" class="btn btn-primary">Primary</button>
                    <button type="button" class="btn btn-secondary">Secondary</button>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-danger">Danger</button>
                    <button type="button" class="btn btn-warning">Warning</button>
                    <button type="button" class="btn btn-info">Info</button>
                    <button type="button" class="btn btn-light">Light</button>
                    <button type="button" class="btn btn-dark">Dark</button>
                    <button type="button" class="btn btn-link">Link</button>
                </div>
            </div>

            <!-- Outline button -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Outline buttons</h3>
                    <button type="button" class="btn btn-outline-primary">Primary</button>
                    <button type="button" class="btn btn-outline-secondary">Secondary</button>
                    <button type="button" class="btn btn-outline-success">Success</button>
                    <button type="button" class="btn btn-outline-danger">Danger</button>
                    <button type="button" class="btn btn-outline-warning">Warning</button>
                    <button type="button" class="btn btn-outline-info">Info</button>
                    <button type="button" class="btn btn-outline-light">Light</button>
                    <button type="button" class="btn btn-outline-dark">Dark</button>
                </div>
            </div>
        </div>
        <div id="alerts" class="tab-pane fade">
            <!-- Alerts -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Alerts</h3>
                    <div class="alert alert-primary" role="alert">
                        This is a primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary" role="alert">
                        This is a secondary alert—check it out!
                    </div>
                    <div class="alert alert-success" role="alert">
                        This is a success alert—check it out!
                    </div>
                    <div class="alert alert-danger" role="alert">
                        This is a danger alert—check it out!
                    </div>
                    <div class="alert alert-warning" role="alert">
                        This is a warning alert—check it out!
                    </div>
                    <div class="alert alert-info" role="alert">
                        This is a info alert—check it out!
                    </div>
                    <div class="alert alert-light" role="alert">
                        This is a light alert—check it out!
                    </div>
                    <div class="alert alert-dark" role="alert">
                        This is a dark alert—check it out!
                    </div>
                </div>
            </div>

            <!-- Dismissing -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Dismissing</h3>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="cards" class="tab-pane fade">
            <!-- Video card -->
            <div class="row">
                <h3 class="col-lg-12">Video card</h3>
                @php $video = \App\Video::first(); @endphp
                <div class="col-xl-3 col-sm-6 mb-3">
                    @include('shared.video.card')
                </div>
            </div>

            <div class="col-md-2">
                <div class="single-video-right">
                    <div class="row">
                        <div class="col-md-12">
                            @include('shared.video.card')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
