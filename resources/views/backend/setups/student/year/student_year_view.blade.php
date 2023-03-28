@extends('layout.admin_master')
@section('title')
    Student Years
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Years</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Student Year</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($studentYears))
                                    @foreach($studentYears as $key => $studentYear)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $studentYear->student_year }}</td>
                                            <td>

                                                <a href="{{ route('student.year.edit', $studentYear->id) }}" type="button" class="btn btn-warning btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('student.year.delete', $studentYear->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No student years found.</h4></td>
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
                        <h4 class="card-title">Add Student Year</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.year.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="student_year" class="col-sm-3 col-form-label">Student Year</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="student_year" id="student_year" placeholder="Student year">
                                    @error('student_year')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Add Year</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

