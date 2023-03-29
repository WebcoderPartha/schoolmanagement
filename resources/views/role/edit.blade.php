@extends('layout.admin_master')
@section('title')
    Edit Role
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
                                    @foreach($roles as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->role_name }}</td>
                                            <td>{{ $value->role_slug }}</td>
                                            <td>

                                                <a href="{{ route('role.edit', $value->id) }}" type="button" class="btn btn-primary btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('role.delete', $value->id) }}" onclick="return confirm('Are you sure to delete?')" type="button" class="btn btn-danger btn-icon-text">
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
                        <h4 class="card-title">Update Role</h4>
                        <form class="forms-sample" method="POST" action="{{ route('role.update', $role->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="role_name" class="col-sm-3 col-form-label">Role Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $role->role_name }}" name="role_name" id="role_name" placeholder="Role name">
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
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
