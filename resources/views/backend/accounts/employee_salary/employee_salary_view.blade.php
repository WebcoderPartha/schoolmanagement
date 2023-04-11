@extends('layout.admin_master')
@section('title')
    Account Employee Salary
@endsection
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Account Employee Salary <a href="{{ route('accounts.employee_salary_add') }}" class="float-right btn btn-sm btn-primary">Add Employee Salary<i class="typcn typcn-plus btn-icon-append"></i></a></h4>



                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID</th>
                                    <th>Employee Name</th>
                                    <th>Salary Month</th>
                                    <th>Salary</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($accountEmployees) > 0)

                                    @foreach($accountEmployees as $key => $accountEmployee)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $accountEmployee->employee->id_number }}</td>
                                            <td>{{ $accountEmployee->employee->name }}</td>
                                            <td>{{ date('F, Y', strtotime($accountEmployee->date)) }}</td>
                                            <td>{{ number_format($accountEmployee->amount, 0) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">  <h4 class="text-center">No salary employees found in account.</h4></td>
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

