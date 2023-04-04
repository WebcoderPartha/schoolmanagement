@extends('layout.admin_master')
@section('title')
    Employee salary details
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h6>Employee Salary Details</h6>
                        <hr>
                        <p>Employee ID : <b>{{ $employee_salaries[0]->employee->id_number }}</b></p>
                        <p>Name : <b>{{ $employee_salaries[0]->employee->name }}</b></p>
                        <p>Joining Date : <b>{{ date('d-F-Y', strtotime($employee_salaries[0]->employee->joining_date)) }}</b></p>
                    </div>
                    <div class="card-body">
                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Previous Salary</th>
                                    <th>Present Salary</th>
                                    <th>Increment Salry</th>
                                    <th>Effected Salary Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($employee_salaries) > 0)

                                    @foreach($employee_salaries as $key => $employee)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $employee->previous_salary }}</td>
                                            <td>{{ $employee->present_salary }}</td>
                                            <td>{{ $employee->increment_salary }}</td>
                                            <td>{{ date('d-F-Y', strtotime($employee->effected_salary_date)) }}</td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <a href="{{ route('employee.salary_pdf_download', $employee_salaries[0]->employee->id) }}" target="_blank" class="btn btn-sm btn-danger btn-icon-text">
                                                <i class="typcn typcn-printer btn-icon-append"></i> Print
                                            </a></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5">  <h4 class="text-center">No Employee salaries found.</h4></td>
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

