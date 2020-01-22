@extends('shared.template')

@section('title')
    Upload a video
@endsection

@section('description')
    Upload a video on 7-Vid in less then 2 minutes.
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-title">
                <h1 class="h2">Upload a video in 3 step.</h1>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group col-lg-12 mx-auto">
                    <div class="p-5 bg-white shadow rounded-lg">
                        <h1 class="text-center">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </h1>

                        <h5 class="text-center mb-4">
                            <b>1. Upload your video</b>
                        </h5>
                        <p class="text-center text-muted">
                            A thumbnail will be generated once you have selected your video
                        </p>

                        <label for="e1" class="file-upload btn btn-primary btn-block rounded-pill shadow">
                            <i class="fa fa-upload mr-2"></i>
                            Browse for file ...
                            <input type="file" name="upload" id="e1" class="form-control-file d-none">
                        </label>
                        <hr>
                        <h6 class="text-center mb-4">
                            <b>Not happy with the generated thumbnail ?</b>
                        </h6>
                        <p class="text-center text-muted">
                            Upload your own
                        </p>
                        <label for="e4" class="file-upload btn btn-primary btn-block rounded-pill shadow">
                            <i class="fa fa-upload mr-2"></i>
                            Browse for file ...
                            <input type="file" name="image" id="e4" class="form-control-file d-none">
                        </label>
                    </div>
                </div>
                <div class="form-group col-lg-12 mx-auto">
                    <div class="p-5 bg-white shadow rounded-lg">
                        <h1 class="text-center">
                            <i class="fas fa-clipboard"></i>
                        </h1>

                        <h5 class="text-center mb-4">
                            <b>2. What is your video about ?</b>
                        </h5>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="e1">Video Title</label>
                                <input type="text" name="title" placeholder="Contrary to popular belief, Lorem Ipsum (2019) is not." id="e1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="e2">Description</label>
                                <textarea rows="3" id="e2" name="description" class="form-control" placeholder="A short description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="e3">Category</label>
                                <select id="e3" class="custom-select" name="category">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->getId() }}">{{ $category->getTitle() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-12 mx-auto">
                    <div class="p-5 bg-white shadow rounded-lg">
                        <h1 class="text-center">
                            <i class="fas fa-filter"></i>
                        </h1>

                        <h5 class="text-center mb-4">
                            <b>3. Optional settings</b>
                        </h5>

                        <div class="col-lg-12">
                            <label class="toggle-check">
                                <input type="checkbox" name="private" class="toggle-check-input">
                                <span class="toggle-check-text"></span>
                                Mark video has hidden
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Nobody, but you, will be able to see this video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>
                        </div>

                        <div class="col-lg-12">
                            <label class="toggle-check">
                                <input type="checkbox" name="allow_comments" class="toggle-check-input" checked>
                                <span class="toggle-check-text"></span>
                                Allow comments
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will be able to comment on your video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>
                        </div>

                        <div class="col-lg-12">
                            <label class="toggle-check">
                                <input type="checkbox" name="allow_votes" class="toggle-check-input" checked>
                                <span class="toggle-check-text"></span>
                                Allow ratings
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will be able to rate this video.">
                                    <i class="far fa-question-circle"></i>
                                </span>
                            </label>
                        </div>

                        <div class="text-center">
                            @include('shared.captcha.recaptcha')
                            <button type="submit" class="btn btn-outline-primary">Share !</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="terms text-center mt-2">
        <p class="mb-0">
            By uploading videos to {{ config('app.name') }}, you agree to the <a href="{{ route('home.terms') }}">Terms of Service</a> and Community Rules.
            Be careful not to infringe the copyright or privacy of others.</p>
    </div>
@endsection
