@extends('shared.template')

@section('body-class')
    "landing-page"
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-title">
                <h6>Upload Details</h6>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="osahan-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="e1">Video file</label>
                                <input type="file" name="upload" id="e1" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="e1">Thumbnail</label>
                                <input type="file" name="image" id="e1" class="form-control-file">
                            </div>
                        </div>
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
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="e3">Category</label>
                                <select id="e3" class="custom-select" name="category">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Other settings</h5>
                <hr>
                <label class="toggle-check">
                    <input type="checkbox" name="private" class="toggle-check-input">
                    <span class="toggle-check-text"></span>
                    Mark video has hidden
                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Nobody, but you, will be able to see this video.">
                        <i class="far fa-question-circle"></i>
                    </span>
                </label>

                <label class="toggle-check">
                    <input type="checkbox" name="allow_comments" class="toggle-check-input" checked>
                    <span class="toggle-check-text"></span>
                    Allow comments
                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will be able to comment on your video.">
                        <i class="far fa-question-circle"></i>
                    </span>
                </label>

                <label class="toggle-check">
                    <input type="checkbox" name="allow_votes" class="toggle-check-input" checked>
                    <span class="toggle-check-text"></span>
                    Allow ratings
                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="People will be able to rate this video.">
                        <i class="far fa-question-circle"></i>
                    </span>
                </label>
            <div class="osahan-area text-center mt-3">
                @include('shared.captcha.recaptcha')
                <button type="submit" class="btn btn-outline-primary">Share !</button>
            </div>
            </form>
            <hr>
            <div class="terms text-center">
                <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority <a href="#">Terms of Service</a> and <a href="#">Community Guidelines</a>.</p>
                <p class="hidden-xs mb-0">Ipsum is therefore always free from repetition, injected humour, or non</p>
            </div>
        </div>
    </div>
@endsection
