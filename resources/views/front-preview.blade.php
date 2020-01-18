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
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#category">Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#price-cards">Price cards</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#comments">Comments</a>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <h6>Channel</h6>
                    </div>
                </div>
                @php $channel = \App\User::first(); @endphp
                <div class="col-xl-3 col-sm-6 mb-3">
                    @include('shared.channel.card')
                </div>
            </div>
        </div>
        <div id="category" class="tab-pane fade">
            <!-- Video card -->
            <div class="row">
                <h3 class="col-lg-12">Category slider</h3>
                @php $categories = \App\Category::all() @endphp
                <div class="col-md-12">
                    <div class="owl-carousel owl-carousel-category">
                        @foreach($categories as $category)
                            <a href="{{ route('category.index', ['name' => $category->title]) }}">
                                <div class="item">
                                    <div class="category-item text-center">
                                        <h3>
                                            <i class="{{ $category->icon }}"></i>
                                        </h3>
                                        <h6>{{ $category->title }}</h6>
                                        <p>{{ $category->getVideosCount() }} videos</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="price-cards" class="tab-pane fade">
            <div class="row flex-items-xs-middle flex-items-xs-center">

                <!-- Table #1  -->
                <div class="col-xs-12 col-lg-4">
                    <div class="card price-card text-xs-center">
                        <div class="price-card-header">
                            <h3 class="display-2"><span class="currency">$</span>19<span class="period">/month</span></h3>
                        </div>
                        <div class="price-card-block">
                            <h4 class="price-card-title">
                                Basic Plan
                            </h4>
                            <ul class="list-group">
                                <li class="list-group-item">Ultimate Features</li>
                                <li class="list-group-item">Responsive Ready</li>
                                <li class="list-group-item">Visual Composer Included</li>
                                <li class="list-group-item">24/7 Support System</li>
                            </ul>
                            <a href="#" class="btn btn-gradient mt-2">Choose Plan</a>
                        </div>
                    </div>
                </div>

                <!-- Table #1  -->
                <div class="col-xs-12 col-lg-4">
                    <div class="card price-card text-xs-center">
                        <div class="price-card-header">
                            <h3 class="display-2"><span class="currency">$</span>29.99<span class="period">/month</span></h3>
                        </div>
                        <div class="price-card-block">
                            <h4 class="price-card-title">
                                Regular Plan
                            </h4>
                            <ul class="list-group text-center">
                                <li class="list-group-item">Ultimate Features</li>
                                <li class="list-group-item">Responsive Ready</li>
                                <li class="list-group-item">Visual Composer Included</li>
                                <li class="list-group-item">24/7 Support System</li>
                            </ul>
                            <a href="#" class="btn btn-gradient mt-2">Choose Plan</a>
                        </div>
                    </div>
                </div>

                <!-- Table #1  -->
                <div class="col-xs-12 col-lg-4">
                    <div class="card price-card text-xs-center">
                        <div class="price-card-header">
                            <h3 class="display-2"><span class="currency">$</span>39<span class="period">/month</span></h3>
                        </div>
                        <div class="price-card-block">
                            <h4 class="price-card-title">
                                Premium Plan
                            </h4>
                            <ul class="list-group">
                                <li class="list-group-item">Ultimate Features</li>
                                <li class="list-group-item">Responsive Ready</li>
                                <li class="list-group-item">Visual Composer Included</li>
                                <li class="list-group-item">24/7 Support System</li>
                            </ul>
                            <a href="#" class="btn btn-gradient mt-2">Choose Plan</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="comments" class="tab-pane fade">
            <div class="row">
                <div class="col-lg-12">
                    <div class="messaging">
                        <div class="inbox_msg">
                            <div class="inbox_people">
                                <div class="headind_srch">
                                    <div class="recent_heading">
                                        <h4>Recent</h4>
                                    </div>
                                </div>
                                <div class="inbox_chat">
                                    <div class="chat_list active_chat">
                                        <div class="chat_people">
                                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_list">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_list">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_list">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_list">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_list">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat_list">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                                <p>Test, which is a new approach to have all solutions
                                                    astrology under one roof.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img">
                                            <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                        </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>Test which is a new approach to have all
                                                    solutions</p>
                                                <span class="time_date"> 11:01 AM    |    June 9</span></div>
                                        </div>
                                    </div>
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>Test which is a new approach to have all
                                                solutions</p>
                                            <span class="time_date"> 11:01 AM    |    June 9</span> </div>
                                    </div>
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img">
                                            <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                        </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>Test, which is a new approach to have</p>
                                                <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
                                        </div>
                                    </div>
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>Apollo University, Delhi, India Test</p>
                                            <span class="time_date"> 11:01 AM    |    Today</span> </div>
                                    </div>
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img">
                                            <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                        </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>We work directly with our designers and suppliers,
                                                    and sell direct to you, which means quality, exclusive
                                                    products, at a price anyone can afford.</p>
                                                <span class="time_date"> 11:01 AM    |    Today</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <input type="text" class="write_msg" placeholder="Type a message" />
                                        <button class="msg_send_btn" type="button"><i class="far fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
