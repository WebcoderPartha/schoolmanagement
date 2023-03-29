@extends('layout.admin_master')
@section('title')
    All Users
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Register Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users))
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if(!empty($user->image))
                                                <img width="100" src="{{ asset($user->image) }}" alt="">
                                                @else
                                                No Image
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role_id !== NULL)
                                                    {{$user->role->role_name}}
                                                @else
                                                    <span>Subscriber</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('d F Y') }}</td>
                                            <td>
                                                @if(Auth::guard('admin')->id() !== $user->id)
                                                <a href="{{ route('user.edit', $user->id) }}" type="button" class="btn btn-primary btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                @else
                                                    <button disabled href="{{ route('user.edit', $user->id) }}" type="button" class="btn btn-primary btn-sm btn-icon-text">
                                                        Edit
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                    </button>
                                                @endif
                                                @if(Auth::guard('admin')->id() !== $user->id)
                                                    <a id="delete" href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-icon-text">
                                                        <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                        Delete
                                                    </a>
                                                @else
                                                    <button  disabled type="button" class="btn btn-danger btn-icon-text">
                                                        <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                        Delete
                                                    </button>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No users found.</h4></td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
