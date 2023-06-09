@extends('layout.admin_master')
@section('title')
    Employee Leaves View
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Leave Employee List <a href="{{ route('employee.leave_add') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-plus btn-icon-append"></i> Add Leave Employee</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Leave Purpose</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($employees) > 0)

                                    @foreach($employees as $key => $employee)

                                        <tr>
                                            <td>{{ $employee->employee->id_number }}</td>
                                            <td>{{ $employee->employee->name }}</td>
                                            <td>{{ $employee->employee->designation->name }}</td>
                                            <td>{{ $employee->leave->name }}</td>
                                            <td>{{ date('d-F-Y', strtotime($employee->start_date)) }}</td>
                                            <td>{{ date('d-F-Y', strtotime($employee->end_date)) }}</td>

                                            <td>

                                                <a title="Edit employee" href="{{ route('employee.leave_edit', ['employee_id' => $employee->employee->id]) }}" class="btn btn-success btn-sm btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
{{--                                                <a href="{{ route('employee.detail', $employee->id_number) }}" class="btn btn-sm btn-primary btn-icon-text">--}}
{{--                                                    <i class="typcn typcn-eye btn-icon-append"></i>--}}
{{--                                                </a>--}}

                                                <a title="Delete Employee" id="delete" href="{{ route('employee.leave_delete', ['employee_id' => $employee->employee->id]) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="typcn typcn-trash btn-icon-append"></i>
                                                </a>
{{--                                                <a href="{{ route('employee.idCard', $employee->id_number) }}" target="_blank" class="btn btn-sm btn-primary btn-icon-text">--}}
{{--                                                    <i class="typcn typcn-printer btn-icon-append"> ID Card</i>--}}
{{--                                                </a>--}}

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">  <h4 class="text-center">No leave employees found.</h4></td>
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

