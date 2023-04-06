@extends('layout.admin_master')
@section('title')
    Employee Attendance List
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee Attendance List <a href="{{ route('employee.attendance_add') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-plus btn-icon-append"></i> Add Employee Attendance</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Attendance Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($employeeAttendances) > 0)

                                    @foreach($employeeAttendances as $key => $attendance)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ date('d-F-Y', strtotime($attendance->date)) }}</td>>

                                            <td>

                                                <a title="Edit Attendance" href="{{ route('employee.attendance_edit', ['date'=> date('d-F-Y', strtotime($attendance->date))]) }}" class="btn btn-success btn-sm btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('employee.attendance_detail', ['date'=> date('d-F-Y', strtotime($attendance->date))]) }}" class="btn btn-sm btn-primary btn-icon-text">
                                                                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                                                                </a>

{{--                                                <a title="Delete Employee" id="delete" href="{{ route('employee.leave_delete', ['employee_id' => $employee->employee->id]) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">--}}
{{--                                                    <i class="typcn typcn-trash btn-icon-append"></i>--}}
{{--                                                </a>--}}
                                                {{--                                                <a href="{{ route('employee.idCard', $employee->id_number) }}" target="_blank" class="btn btn-sm btn-primary btn-icon-text">--}}
                                                {{--                                                    <i class="typcn typcn-printer btn-icon-append"> ID Card</i>--}}
                                                {{--                                                </a>--}}

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">  <h4 class="text-center">No employees attendance found.</h4></td>
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

