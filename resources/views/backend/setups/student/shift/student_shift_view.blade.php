@extends('layout.admin_master')
@section('title')
    Student Shifts
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Shifts</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Student Shift</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($studentShifts))
                                    @foreach($studentShifts as $key => $studentShift)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $studentShift->student_shift }}</td>
                                            <td>

                                                <a href="{{ route('student.shift.edit', $studentShift->id) }}" type="button" class="btn btn-warning btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('student.shift.delete', $studentShift->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No student shifts found.</h4></td>
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
                        <h4 class="card-title">Add Student Shift</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.shift.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="student_shift" class="col-sm-3 col-form-label">Student Shift</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="student_shift" id="student_shift" placeholder="Student shift">
                                    @error('student_shift')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Add Shift</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

