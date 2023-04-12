@extends('layout.admin_master')
@section('title')
    Add Student Fee in account
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4>Add Student Fee <a href="{{ route('accounts.student_fee_view') }}" class="btn btn-sm btn-info float-right">Back</a></h4>

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
                                        <option  value="{{ $class->id }}">{{ $class->class_name }}</option>
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
                                    <option value="registration_fee">Registration Fee</option>
                                    <option  value="monthly_fee">Monthly Fee</option>
                                    <option value="exam_fee">Exam Fee</option>
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
                                        <option  value="{{ $month->id }}">{{ $month->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2" style="display:none;" id="exam_type_fee">

                            <div class="form-group">
                                <label for="exam_type_id">Exam Type</label>
                                <select class="form-control" name="exam_type_id" id="exam_type_id">
                                    <option value="">Select exam type</option>
                                    @foreach($examTypes as $examType)
                                        <option  value="{{ $examType->id }}">{{ $examType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date">
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

        <!-- Registration Fee -->
        @if(isset($assignStudents) && count($assignStudents) > 0 && isset($registrationFee))
            <form action="{{ route('accounts.student.store') }}" method="POST">
                @csrf
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
                                        @foreach($assignStudents as $key => $student)

                                            @php
                                                $discountRow = \App\Models\Discount::where([
                                                    'student_id'=>$student->student->id,
                                                    'student_year_id' => $student->year_id,
                                                    'student_class_id' => $student->class_id
                                                ])->first();
                                                $discount =  $discountRow->discount_percentage;
                                                $regiFee = $registrationFee->fee_amount;
                                                $parcentValue = ((float)$regiFee/100)*(float)$discount;
                                                $RegiFinal = (float)$regiFee - (float)$parcentValue;

                                                $regiCheck = \App\Models\AccountStudentFee::where([
                                                    'year_id' => $student->year_id,
                                                    'class_id' => $student->class_id,
                                                    'student_id' => $student->student->id,
                                                    'fee_name' => 'Registration',
                                                   // 'date' => date('m-Y', strtotime($_GET['date']))

                                                ])->first();
                                                if ($regiCheck !== NULL){
                                                    $check = 'checked';
                                                }else{
                                                    $check = '';
                                                }
                                            @endphp
                                        <tr>
                                            <td>{{ $student->student->id_number }} <input type="hidden" value="{{ $student->student->id }}" name="student_id[]"></td>
                                            <td>{{ $student->student->name }}</td>
                                            <td>{{ $student->year->student_year }} <input type="hidden" value="{{ $student->year->id }}" name="year_id"></td>
                                            <td>{{ $student->class->class_name }} <input type="hidden" value="{{ $student->class->id }}" name="class_id"></td>
                                            <td>Registration Fee ({{ $discount }}% discount) <input type="hidden" name="choose_fee" value="{{ $choose_fee }}"></td>
                                            <td>{{ $RegiFinal }} <input type="hidden" value="{{ $RegiFinal }}" name="amount[]"></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="date" name="date" value="{{ date('Y-m-d', strtotime($date))  }}">
                                                            <input type="checkbox" name="checkBox[]" class="form-check-input" {{$check}} value="{{ $key}}">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <input class="btn btn-primary" type="submit" value="Submit to Account">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        @endif
    <!-- End Registration Fee -->


        <!-- Monthly Fee -->
        @if(isset($assignStudents) && count($assignStudents) > 0 && isset($monthlyFee))
            <form action="{{ route('accounts.student.store') }}" method="POST">
                @csrf
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
                                        @foreach($assignStudents as $key =>  $student)
                                            @php
                                                $monthlyCheck = \App\Models\AccountStudentFee::where([
                                                    'year_id' => $student->year_id,
                                                    'class_id' => $student->class_id,
                                                    'student_id' => $student->student->id,
                                                    'fee_name' => $monthlyFee->month->name,
                                                   // 'date' => date('m-Y', strtotime($_GET['date']))

                                                ])->first();

                                                if ($monthlyCheck !== NULL){
                                                    $check = 'checked';
                                                }else{
                                                    $check = '';
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{ $student->student->id_number }} <input type="hidden" value="{{ $student->student->id }}" name="student_id[]"></td>
                                                <td>{{ $student->student->name }}</td>
                                                <td>{{ $student->year->student_year }} <input type="hidden" value="{{ $student->year->id }}" name="year_id"></td>
                                                <td>{{ $student->class->class_name }} <input type="hidden" value="{{ $student->class->id }}" name="class_id"></td>
                                                <td>Monthly Fee ( {{ $monthlyFee->month->name }}) <input type="hidden" name="fee_name" value="{{ $monthlyFee->month->name }}"> <input type="hidden" name="choose_fee" value="{{ $choose_fee }}"></td>
                                                <td>{{ $monthlyFee->fee_amount }} <input type="hidden" name="amount[]" value="{{ $monthlyFee->fee_amount }}"></td>
                                                <td>
                                                    <input type="hidden" name="date" value="{{ (!empty($_GET['date']))? date('Y-m-d', strtotime($_GET['date'])) : '' }}">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" name="checkBox[]" {{ $check }} value="{{ $key }}" class="form-check-input">
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <input class="btn btn-primary" type="submit" value="Submit to Account">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    @endif
    <!-- End Monthly Fee -->

        <!-- Exam Fee -->
        @if(isset($assignStudents) && count($assignStudents) > 0 && isset($examFee))
            <form action="{{ route('accounts.student.store') }}" method="POST">
                @csrf
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
                                        @foreach($assignStudents as $key => $student)
                                            @php
                                                $examCheck = \App\Models\AccountStudentFee::where([
                                                    'year_id' => $student->year_id,
                                                    'class_id' => $student->class_id,
                                                    'student_id' => $student->student->id,
                                                    'fee_name' => $examFee->exam->name,
                                                   // 'date' => date('m-Y', strtotime($_GET['date']))

                                                ])->first();

                                                if ($examCheck !== NULL){
                                                    $check = 'checked';
                                                }else{
                                                    $check = '';
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{ $student->student->id_number }} <input type="hidden" value="{{ $student->student->id }}" name="student_id[]"></td>
                                                <td>{{ $student->student->name }}</td>
                                                <td>{{ $student->year->student_year }} <input type="hidden" value="{{ $student->year->id }}" name="year_id"></td>
                                                <td>{{ $student->class->class_name }} <input type="hidden" value="{{ $student->class->id }}" name="class_id"></td>
                                                <td>{{$examFee->exam->name}} <input type="hidden" name="fee_name" value="{{ $examFee->exam->name }}"></td>
                                                <td>{{ $examFee->fee_amount }} <input type="hidden" name="amount[]" value="{{ $examFee->fee_amount }}"><input
                                                            type="hidden" name="choose_fee" value="{{ $choose_fee }}"></td>
                                                <td>
                                                   <div class="form-group">
                                                       <input type="hidden" name="date" value="{{ (!empty($_GET['date']))? date('Y-m-d', strtotime($_GET['date'])) : '' }}">
                                                       <div class="form-check">
                                                           <label class="form-check-label">
                                                               <input type="checkbox" {{ $check }} name="checkBox[]" value="{{$key}}" class="form-check-input">
                                                               <i class="input-helper"></i></label>
                                                       </div>
                                                   </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <input class="btn btn-primary" type="submit" value="Submit to Account">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        @endif
    <!-- End Exam Fee -->

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

