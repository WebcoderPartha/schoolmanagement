@extends('layout.admin_master')
@section('title')
    Add Student Fee in account
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Add Student Fee</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('accounts.student.search') }}" method="GET">
                    <div class="row search">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option
                                                {{ (isset($_GET['year_id']) == $year->id) ? 'selected' : '' }}
                                                value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                                @error('year_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select class</option>
                                    @foreach($classes as $class)
                                        <option {{ (!empty($_GET['class_id']) == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label for="choose_fee">Choose Fee</label>
                                <select class="form-control" name="choose_fee" id="choose_fee">
                                    <option value="">Select class</option>
                                    <option {{ (!empty($_GET['choose_fee']) == 'registration_fee' ) ? 'selected' : '' }} value="registration_fee">Registration Fee</option>
                                    <option {{ (!empty($_GET['choose_fee']) == 'monthly_fee' ) ? 'selected' : '' }} value="monthly_fee">Monthly Fee</option>
                                    <option {{ (!empty($_GET['choose_fee']) == 'exam_fee' ) ? 'selected' : '' }} value="exam_fee">Exam Fee</option>
                                </select>
                                @error('choose_fee')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2" style="display: none" id="monthly_fee_month">

                            <div class="form-group">
                                <label for="month_id">Month</label>
                                <select class="form-control" name="month_id" id="month_id">
                                    <option value="">Select Month</option>
                                    @foreach($months as $month)
                                        <option {{ (!empty($_GET['month_id']) == $month->id ) ? 'selected' : '' }} value="{{ $month->id }}">{{ $month->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2" style="display:none;" id="exam_type_fee">

                            <div class="form-group">
                                <label for="month_id">Exam Type</label>
                                <select class="form-control" name="exam_type_id" id="exam_type_id">
                                    <option value="">Select exam type</option>
                                    @foreach($examTypes as $examType)
                                        <option {{ (!empty($_GET['exam_type_id']) == $examType->id ) ? 'selected' : '' }} value="{{ $examType->id }}">{{ $examType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input value="{{ (!empty($_GET['date'])) ? date('Y-m-d', strtotime($_GET['date'])) : '' }}" type="date" class="form-control" name="date" id="date">
                                @error('date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary" style="margin-top:30px">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($assignStudents) && count($assignStudents) > 0)
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Fee Category</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignStudents as $student)

                                    @php
                                        $discountRow = \App\Models\Discount::where([
                                            'student_id'=>$student->student->id,
                                            'student_year_id' => $student->year_id,
                                            'student_class_id' => $student->class_id
                                        ])->first();
                                        $discount =  $discountRow->discount_percentage;
                                        $regiFee = $registrationFee->fee_amount;
                                        $parcentValue = ((float)$regiFee/100)*(float)$discount;
                                        $RegiFinal = (float)$regiFee - (float)$parcentValue
                                    @endphp
                                <tr>
                                    <td>{{ $student->student->id_number }}</td>
                                    <td>{{ $student->student->name }}</td>
                                    <td>{{ $student->year->student_year }}</td>
                                    <td>{{ $student->class->class_name }}</td>
                                    <td>Registration Fee</td>
                                    <td>{{ $RegiFinal }}</td>
                                    <td>
                                        <input type="checkbox" name="checkBox" value="1">
                                    </td>
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

    <script type="text/javascript">
        $(document).ready(function (){
            $(document).on('change', '#choose_fee', function (){
                let value = $(this).val();
                if (value === 'monthly_fee'){
                    $('#monthly_fee_month').show();
                }else{
                    $('#monthly_fee_month').hide();
                }


                    if (value === 'exam_fee'){
                    $('#exam_type_fee').show();
                }else{
                    $('#exam_type_fee').hide();
                }

            });
        });
    </script>

@endsection

