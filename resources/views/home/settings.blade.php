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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name" class="control-label">Name <span class="required">*</span></label>
                    <input class="form-control border-form-control" value="{{ Auth::user()->getName() }}" name="name" type="text">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email" class="control-label">Email Address <span class="required">*</span></label>
                    <input class="form-control border-form-control" value="{{ Auth::user()->getEmail() }}" name="email" type="text">
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
                    <input class="form-control border-form-control" value="" name="current-password" placeholder="123456" type="password">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="password" class="control-label">New password</label>
                    <input class="form-control border-form-control" value="" name="password" placeholder="123456" type="password">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="confirm-password" class="control-label">Confirm new password</label>
                    <input class="form-control border-form-control" value="" name="confirm-password" placeholder="123456" type="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <hr>
                <h6>Personal informations</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Country <span class="required">*</span></label>
                    <select name="country" class="custom-select">
                        @foreach(\App\Country::all() as $country)
                            <option value="{{ $country->getId() }}" {{ Auth::user()->country->id === $country->getId() ? 'selected' : '' }}>{{ $country->getCountryName() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-success border-none"> Save Changes</button> or CTRL+S
            </div>
        </div>
    </form>
    </div>
@endsection
