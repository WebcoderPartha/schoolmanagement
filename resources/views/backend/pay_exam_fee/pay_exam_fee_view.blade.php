@extends('layout.admin_master')
@section('title')
    Pay Exam Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Pay Exam Fee</h4>
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
                                            @if(isset($students))
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
                                            @if(isset($students))
                                                {{ ($exam_fee->exam_type_id == $examType->id) ? 'selected' : '' }} @endif
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
                                            @if(isset($students))
                                                {{ ($students[0]->class_id == $class->id) ? 'selected' : '' }} @endif
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
        @if(isset($students))
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student List </h4>
                            <div class="table-respnsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL</th>

                                        <th>Name</th>
                                        <th>Student ID</th>
                                        <th>Roll</th>
                                        <th>Discount</th>
                                        <th>Regi. Fee (After Discount)</th>
                                        <th>Pay Slip</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($students as $key => $student)
                                        @php
                                            $discount = \App\Models\Discount::where('student_id', $student->student_id)->first();
                                            $discount_amount = $discount->discount;
                                            $dis_fee_cat_id = $discount->fee_category_id;
                                            $feeCatAmount = \App\Models\FeeCategoryAmount::where('student_class_id', $student->class_id)->where('fee_category_id', $dis_fee_cat_id)->first();
                                            $origianAmount = $feeCatAmount->amount;
                                            $parcentage = ((float)$origianAmount*(float)$discount_amount)/100;
                                            $finalAmount = $origianAmount-$parcentage;

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$student->student->name}}</td>
                                            <td>{{$student->student->id_number}}</td>
                                            <td>{{$student->roll_number}}</td>
                                            <td>{{ $discount->discount }}%</td>
                                            <td>{{ $finalAmount }}</td>
                                            <td><a target="_blank" href="{{ route('registration.pay.slip',['year'=>$student->year_id, 'class' => $student->class_id, 'student_id' => $student->id]) }}">Pay Slip</a></td>
                                        </tr>


                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

@endsection

