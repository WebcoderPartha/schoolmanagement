@extends('layout.admin_master')
@section('title')
    Student Groups
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Groups</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Student Group</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($studentGroups))
                                    @foreach($studentGroups as $key => $studentGroup)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $studentGroup->student_group }}</td>
                                            <td>

                                                <a href="{{ route('student.group.edit', $studentGroup->id) }}" type="button" class="btn btn-warning btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('student.group.delete', $studentGroup->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No student groups found.</h4></td>
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
                        <h4 class="card-title">Add Student Group</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.group.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="student_group" class="col-sm-3 col-form-label">Student Group</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="student_group" id="student_group" placeholder="Student Group">
                                    @error('student_group')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Add Group</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

