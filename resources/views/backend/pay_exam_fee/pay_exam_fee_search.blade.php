@extends('layout.admin_master')
@section('title')
    Exam Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4> Exam Fee</h4>
            </div>
            <div class="card-body">
                <form action="{{route('payExamFee.search')}}" method="GET">
                    <div class="row search">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option
                                            @if(count($students) > 0)
                                                {{ ($students[0]->year_id == $year->id) ? 'selected' : '' }} @endif
                                            value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="exam_type_id">Exam Type</label>
                                <select class="form-control" name="exam_type_id" id="exam_type_id">
                                    <option value="">Select exam type</option>
                                    @foreach($examTypes as $examType)
                                        <option
                                            @if(isset($examFees))
                                                {{ ($examFees->exam_type_id == $examType->id) ? 'selected' : '' }} @endif
                                            value="{{ $examType->id }}">{{ $examType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select class</option>
                                    @foreach($classes as $class)
                                        <option
                                            @if(count($students) > 0)
                                                {{ $students[0]->class_id == $class->id ? 'selected' : '' }} @endif
                                            value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3"><button type="submit" class="btn btn-primary" id="searchButton" style="margin-top:30px">Search</button></div>
                    </div>
                </form>
            </div>
        </div>
        @if(count($students) > 0 && isset($examFees))
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student List </h4>
                        </div>
                        <div class="card-body">

                            <div class="table-respnsive">
                                <table class="table table-hover">

                                    <thead>
                                    <tr>
                                        <th>SL</th>

                                        <th>Name</th>
                                        <th>Student ID</th>
                                        <th>Roll</th>
                                        <th>Exam Fee</th>
                                        <th>Pay Slip</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($students) > 0)
                                        @foreach($students as $key => $student)




                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$student->student->name}}</td>
                                                <td>{{$student->student->id_number}}</td>
                                                <td>{{$student->roll_number}}</td>
                                                <td>{{ $examFees->fee_amount }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="{{ route('payExamFee.pay.slip',['year_id'=>$student->year_id, 'class_id' => $student->class_id, 'student_id' => $student->student_id, 'exam_type_id' => $examFees->exam_type_id]) }}">Pay Slip</a>
                                                </td>
                                            </tr>


                                        @endforeach
                                    @else
                                        <h2>No Exam fee found!</h2>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <h4 class="card-header text-center">Student List </h4>
                        <div class="card-body text-center">

                            <h5>No monthly fee classes student found</h5>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

@endsection

