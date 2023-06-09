@extends('layout.admin_master')
@section('title')
    Student Classes
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Classes</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($studentClasses))
                                    @foreach($studentClasses as $key => $studentClass)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $studentClass->class_name }}</td>
                                            <td>

                                                <a href="{{ route('student.class.edit', $studentClass->id) }}" type="button" class="btn btn-sm btn-warning btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('student.class.delete', $studentClass->id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No classes found.</h4></td>
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
                        <h4 class="card-title">Add Class</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.class.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="class_name" class="col-sm-3 col-form-label">Class Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="class_name" id="class_name" placeholder="Class name">
                                    @error('class_name')
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

