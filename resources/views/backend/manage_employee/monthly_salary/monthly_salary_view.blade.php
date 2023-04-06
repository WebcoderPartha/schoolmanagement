@extends('layout.admin_master')
@section('title')
    Employee Monthly Salary
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4> Employee Monthly Salary</h4>
            </div>
            <div class="card-body">
                <form action="{{route('employees.monthlySalary_search')}}" method="GET">
                    <div class="row search">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary" id="searchButton" style="margin-top:30px">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($attendEmployees))
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title">Monthly Salary Employee List</h4>
                            <hr>
                            <h4 class="card-title">{{ date('F, Y', strtotime($_GET['date'])) }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-respnsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Basic Salary</th>
                                        <th>Salary This Month</th>
                                        <th>Pay Slip</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attendEmployees as $key => $attendEmployee)

                                        @php
                                        $employee_id = $attendEmployee->employee->id;
                                            $employee_present = \App\Models\EmployeeAttendance::where('employee_id', $employee_id)->where('attendance_status', 'Present')->count();
                                        $employeeBasicSalary = $attendEmployee->employee->salary;
                                        $perDaySalary = (float)$employeeBasicSalary/30;
                                        $totalPresentSalary = (float)$perDaySalary*$employee_present

                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$attendEmployee->employee->id_number}}</td>
                                            <td>{{$attendEmployee->employee->name}}</td>
                                            <td>{{$attendEmployee->employee->salary}} Tk</td>
                                            <td>{{ number_format($totalPresentSalary, 0) }} Tk</td>
                                            <td><a class="btn btn-primary" target="_blank" href="{{ route('employees.paySlipmonthlySalary_search', ['date' => date('F-Y', strtotime($_GET['date'])), 'employee_id' => $attendEmployee->employee->id]) }}">Pay Slip</a></td>
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

