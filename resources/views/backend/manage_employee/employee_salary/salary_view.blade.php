@extends('layout.admin_master')
@section('title')
    Employee Salaries
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee Salary List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($employees) > 0)

                                    @foreach($employees as $key => $employee)

                                        <tr>
                                            <td>{{ $employee->id_number }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->joining_date }}</td>
                                            <td>{{ $employee->salary }}</td>
                                            <td>
                                                <a title="Increment Salary" href="{{ route('employee.salary_increment', $employee->id) }}" class="btn btn-sm btn-info btn-icon-text">
                                                    <i class="typcn typcn-plus btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('employee.salary_detail', $employee->id) }}" class="btn btn-sm btn-primary btn-icon-text">
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>

                                                <a href="{{ route('employee.salary_pdf', $employee->id) }}" target="_blank" class="btn btn-sm btn-primary btn-icon-text">
                                                    <i class="typcn typcn-printer btn-icon-append"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">  <h4 class="text-center">No Employee found.</h4></td>
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

