@extends('shared.template')

@section('title')
    User settings
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-title">
                <h1 class="h2">Settings</h1>
                <hr>
            </div>
        </div>
    </div>
    <form method="POST" id="save-on-keyboard">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-2 text-center">
                <img class="author-img " src="{{ getImage(route('cdn.img.avatar'), Auth::user()->getAvatar()) }}" loading="lazy" width="250px" height="250px" alt="Avatar">
                <h3 style="padding-top: 10px;">{{ Auth::user()->getName() }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email" class="control-label">Email Address <span class="required">*</span></label>
                    <input class="form-control border-form-control" value="{{ Auth::user()->getEmail() }}" maxlength="255" min="3" name="email" type="email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <hr>
                <h6>Change password</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="current-password" class="control-label">Current password</label>
                    <input class="form-control border-form-control" maxlength="255" value="" name="current-password" type="password">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group pass-strength-visible">
                    <label for="password" class="control-label">New password</label>
                    <input class="form-control border-form-control password" maxlength="259" value="" name="password" type="password">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="confirm-password" class="control-label">Confirm new password</label>
                    <input class="form-control border-form-control" maxlength="259" value="" name="confirm-password" type="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <hr>
                <h6>Personal information</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Country <span class="required">*</span></label>
                    <select name="country" class="custom-select">
                        @foreach(\App\Country::all() as $country)
                            <option value="{{ $country->getId() }}" {{ Auth::user()->country->getId() === $country->getId() ? 'selected' : '' }}>
                                {{ $country->getCountryName() }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <hr>
                <a href="#" data-toggle="collapse" data-target="#more_settings" aria-expanded="false" aria-controls="more_settings">More settings</a>
                <div class="collapse multi-collapse" id="more_settings">
                    <button type="button" class="btn btn-large btn-primary mt-2" data-toggle="modal" data-target="#deleteModal">Delete my account</button>
                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="We will delete everything related to your account. This action is not reversible.">
                        <i class="far fa-question-circle"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 text-right">
            <button type="submit" class="btn btn-success border-none">Save Changes</button> {{ !isMobile() ? 'or CTRL+S' : '' }}
        </div>
    </form>

    @include('shared.modals.delete')
    <form id="delete" action="{{ route('channel.delete') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/password-strength-meter@1.2.2/dist/password.min.js"></script>
    <script>
        if($('.password').length){
            $('.password').password({
                shortPass: 'This is really short...',
                badPass: 'Looks weak! Try combining letters & numbers',
                goodPass: 'Could be better! Try using special charecters',
                strongPass: 'You got it!',
                showText: true, // shows the text tips
                animate: true, // whether or not to animate the progress bar on input blur/focus
                animateSpeed: 'fast', // the above animation speed
                minimumLength: 3 // minimum password length (below this threshold, the score is 0)
            });
        }
    </script>
@endsection
