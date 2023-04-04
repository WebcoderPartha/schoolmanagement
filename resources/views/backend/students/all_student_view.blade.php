@extends('layout.admin_master')
@section('title')
    Student List
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('student.search') }}" method="GET">
                    <div class="row search">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option
                                            @if(count($allData) > 0)
                                                @if($allData[0]->year_id == $year->id) selected @endif
                                        @endif
                                        value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select class</option>
                                    @foreach($classes as $class)
                                        <option
                                            @if(count($allData) > 0)
                                                @if($allData[0]->class_id == $class->id) selected @endif
                                            @endif
                                        value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4"><button type="submit" class="btn btn-primary" style="margin-top:30px">Search</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student List <a href="{{ route('student.registration') }}" class="float-right btn btn-sm btn-primary">Register Student<i class="typcn typcn-plus btn-icon-append"></i></a></h4>



                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Name</th>
                                    <th>Student ID</th>
                                    <th>Roll</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($allData) > 0)

                                    @foreach($allData as $key => $student)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $student->year->student_year }}</td>
                                            <td>{{ $student->class->class_name }}</td>
                                            <td>{{ (!empty($student)) ? $student->student->name : '' }}</td>
                                            <td>{{ $student->student->id_number }}</td>
                                            <td>{{ $student->roll_number }}</td>
                                            <td><img src="{{ (!empty($student->student->image))? asset($student->student->image) : '' }}" width="150" alt=""></td>

                                            <td>

                                                <a href="{{ route('student.regi.edit', $student->student_id) }}" type="button" class="btn btn-success btn-sm btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('student.detail.get', $student->student_id) }}" target="_blank" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>

                                                <a id="delete" href="{{ route('registudent.delete', ['year_id' =>$student->year->id, 'class_id'=> $student->class->id, 'student_id' =>$student->student->id]) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('student.detail.pdf', $student->student_id) }}" target="_blank" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    <i class="typcn typcn-printer btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('student.promotion', $student->student_id) }}" target="_blank" class="btn btn-sm btn-warning text-white">
                                                    Promotion
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No student found.</h4></td>
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

