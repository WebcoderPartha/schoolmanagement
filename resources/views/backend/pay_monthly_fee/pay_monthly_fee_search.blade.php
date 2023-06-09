@extends('layout.admin_master')
@section('title')
    Monthly Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4> Monthly Fee</h4>
            </div>
            <div class="card-body">
                <form action="{{route('payMonthlyFee.search')}}" method="GET">
                    <div class="row search">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option
                                            @if(isset($students))
                                                {{ ($student_year->id == $year->id) ? 'selected' : '' }} @endif
                                            value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="month_id">Month</label>
                                <select class="form-control" name="month_id" id="month_id">
                                    <option value="">Select Month</option>
                                    @foreach($months as $month)
                                        <option
                                            @if(isset($monthlyFee))
                                                {{ ($monthsss->id == $month->id) ? 'selected' : '' }} @endif
                                            value="{{ $month->id }}">{{ $month->name }}</option>
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
                                                {{ $student_class->id == $class->id ? 'selected' : '' }} @endif
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
        @if(count($students) > 0)
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
                                        <th>Monthly Fee</th>
                                        <th>Pay Slip</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($students) > 0)
                                        @foreach($students as $key => $student)


                                            @php
                                                $discount = \App\Models\Discount::where('student_id', $student->student_id)->where('student_year_id', $student->year_id)->where('student_class_id', $student->class_id)->first();

                                                $discountAmount = $discount->discount_percentage;
                                                $regi_fee = \App\Models\Backend\RegistrationFee::where('student_year_id', $student->year_id)->where('student_class_id', $student->class_id)->first();
                                                $originalAmount = $regi_fee->fee_amount;
                                                $percentage = ((float)$originalAmount*(float)$discountAmount)/100;
                                                $finalAmount = $originalAmount-$percentage;
                                            @endphp

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$student->student->name}}</td>
                                                <td>{{$student->student->id_number}}</td>
                                                <td>{{$student->roll_number}}</td>
                                                <td>{{!empty($monthlyFee->fee_amount) ? $monthlyFee->fee_amount : ''}}</td>
                                                <td><a class="btn btn-sm btn-primary" href="{{ route('payMonthlyFee.pay.slip',['year_id'=>$student->year_id, 'class_id' => $student->class_id, 'student_id' => $student->student_id, 'month_id' => $monthsss->id]) }}">Pay Slip</a></td>
                                            </tr>


                                        @endforeach
                                    @else
                                        <h2>No Monthly fee found!</h2>
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

