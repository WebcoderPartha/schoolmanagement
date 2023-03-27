@extends('layout.admin_master')
@section('title')
    Create Role
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Role</h4>
                        <form class="forms-sample" method="POST" action="{{ route('role.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="role_name" class="col-sm-3 col-form-label">Role Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="role_name" placeholder="Role name">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Add</button>
                            <a href="{{ route('role.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
