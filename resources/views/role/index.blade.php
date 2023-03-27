@extends('layout.admin_master')
@section('title')
    All Role
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Role List</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Role Name</th>
                                    <th>Role Slug</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($roles))
                                    @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->role_slug }}</td>
                                    <td>

                                        <a href="{{ route('role.edit', $role->id) }}" type="button" class="btn btn-warning btn-icon-text">
                                            <i class="typcn typcn-edit btn-icon-prepend"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('role.delete', $role->id) }}" onclick="return confirm('Are you sure to delete?')" type="button" class="btn btn-danger btn-icon-text">
                                            <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No roles found.</h4></td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Role</h4>
                        <form class="forms-sample" method="POST" action="{{ route('role.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="role_name" class="col-sm-3 col-form-label">Role Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Role name">
                                    @error('role_name')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Add</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
