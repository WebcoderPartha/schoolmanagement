@extends('layout.admin_master')
@section('title')
    Edit Group
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">


            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Group</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.group.update', $studentGroup->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="student_group" class="col-sm-3 col-form-label">Student Group</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $studentGroup->student_group }}" name="student_group" id="student_group" placeholder="Student Group">
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

