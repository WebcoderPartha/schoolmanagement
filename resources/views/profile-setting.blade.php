@extends('layout.admin_master')
@section('title')
    Profile Settings
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profile Update</h4>
                        <form class="forms-sample" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ $currentUser->name }}" class="form-control" name="name" id="name" placeholder="name">
                                    @error('name')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ $currentUser->username }}" disabled class="form-control" name="username" id="username" placeholder="name">
                                    @error('username')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ $currentUser->email }}" class="form-control" name="email" id="email" placeholder="email">
                                    @error('email')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <input type="hidden" value="{{ $currentUser->id }}" name="id">
                                    <button type="submit" class="btn btn-primary mr-2">Update Profile</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        <form class="forms-sample" method="POST" action="{{ route('profile.update.password') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="old_password" class="col-sm-3 col-form-label">Old Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old password">
                                    @error('old_password')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="New password">
                                    @error('password')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                                    @error('password_confirmation')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <input type="hidden" value="{{ $currentUser->id }}" name="id">
                                    <button type="submit" class="btn btn-primary mr-2">Change Password</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
