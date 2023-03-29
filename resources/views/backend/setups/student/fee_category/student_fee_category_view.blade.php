@extends('layout.admin_master')
@section('title')
   Student Fee Category
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Fee Category</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Student Fee Category</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($feeCategories))
                                    @foreach($feeCategories as $key => $feeCategory)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $feeCategory->name }}</td>
                                            <td>

                                                <a href="{{ route('student.fcategory.edit', $feeCategory->id) }}" type="button" class="btn btn-warning btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('student.fcategory.delete', $feeCategory->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No student fee category found.</h4></td>
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
                        <h4 class="card-title">Add Student Fee Category</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.fcategory.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Student Fee Category</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Student fee category">
                                    @error('name')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Add Fee Category</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

