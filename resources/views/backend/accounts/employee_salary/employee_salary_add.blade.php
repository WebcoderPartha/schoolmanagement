@extends('layout.admin_master')
@section('title')
    Add Employee Salary
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Add Employee Salary</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('accounts.employee_salary_search') }}" method="GET">
                    <div class="row search">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date">Select Salary Date</label>
                                <input type="date" value="{{ (!empty($date)) ? date('Y-m-d', strtotime($date)) : '' }}" class="form-control" name="date" id="date">
                                @error('date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary" style="margin-top:30px">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Registration Fee -->
        @if(isset($employeesAttend) && count($employeesAttend))
            <form action="{{ route('accounts.store_employee_salary') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="header p-3">
                                <h3 class="text-center"> {{ date('F, Y', strtotime($date)) }}</h3>
                            </div>
                            <div class="card-body">

                                <div class="table-respnsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>ID</th>
                                            <th>Employee Name</th>
                                            <th>Salary Month</th>
                                            <th>Basic Salary</th>
                                            <th>This Month Salary</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employeesAttend as $key => $employeeAttend)

                                            @php
                                                echo $accountSalary = \App\Models\AccountEmployeeSalary::where([
                                                                    'employee_id' => $employeeAttend->employee->id,
                                                                    'date' => date('F, Y', strtotime($_GET['date']))
                                                                ])->first();
                                                if ($accountSalary){
                                                    $check = 'checked';
                                                }else{
                                                    $check = '';
                                                }

                                                $present = \App\Models\EmployeeAttendance::where('employee_id', $employeeAttend->employee->id)->where('attendance_status', 'Present')->where('date', 'LIKE', '%'.date('m-Y', strtotime($_GET['date'])).'%')->count();
                                                $perdaySalary = $employeeAttend->employee->salary / 30;
                                                $totalSalary = (float)$perdaySalary * (float)$present
                                            @endphp

                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $employeeAttend->employee->id_number }} <input type="hidden" name="employee_id[]" value="{{ $employeeAttend->employee->id }}"></td>
                                                <td>{{ $employeeAttend->employee->name }}</td>
                                                <td>{{ date('F', strtotime($date)) }}</td>
                                                <td>{{ $employeeAttend->employee->salary }}</td>
                                                <td>{{ number_format($totalSalary, 0) }} <input type="hidden" name="amount[]" value="{{ $totalSalary }}"></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="date" name="date" value="{{ date('Y-m-d', strtotime($_GET['date']))  }}">
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
    </div>


@endsection

