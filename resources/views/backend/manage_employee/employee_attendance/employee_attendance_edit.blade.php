@extends('layout.admin_master')
@section('title')
    Employee Attendance
@endsection
<style type="text/css">
    .table td {
        text-align: center !important;
        padding: 10px 5px !important;
        border: 1px solid #00c8bf !important;
    }
    .form-check .form-check-label {
        margin-left: 0 !important;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <form action="{{ route('employee.attendance_update', ['date' => date('d-F-Y', strtotime($attendances[0]->date))]) }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                       <h4>Edit Employee Attendance</h4>
                       <h5> {{date('d-F-Y', strtotime($attendances[0]->date))}}</h5>
                        <hr>
                        <div class="form-group col-4 mx-auto ">
                            <label for="date"> <b>Attendance Date</b></label>
                            <input type="date" name="date" value="{{ date('Y-m-d', strtotime($attendances[0]->date)) }}" class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-respnsive text-center">
                            <table class="table table-hover" border="1">
                                <tr>
                                    <td rowspan="2">SL</td>
                                    <td rowspan="2">Employee ID</td>
                                    <td rowspan="2">Employee Name</td>
                                    <td colspan="3">Attendance Status</td>
                                </tr>
                                <tr bgcolor="#00c8bf" style="color: #fff !important;">
                                    <td>Present</td>
                                    <td>Absent</td>
                                    <td>Leave</td>
                                </tr>
                                @foreach($attendances as $key => $attendance)
                                <tr id="employee-{{$attendance->employee_id}}">
                                    <input type="hidden" name="employee_id[]" value="{{$attendance->employee_id}}">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $attendance->employee->id_number }}</td>
                                    <td>{{$attendance->employee->name}}</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input  {{($attendance->attendance_status == 'Present') ? 'checked' : '' }} type="radio" class="form-check-input" name="attendance_status{{$key}}" id="present{{$key}}" value="Present">
                                                    Present
                                                </label>
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input {{($attendance->attendance_status == 'Absent') ? 'checked' : '' }} type="radio" class="form-check-input" name="attendance_status{{$key }}" id="absent{{$key}}" value="Absent">
                                                    Absent
                                                </label>
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input {{($attendance->attendance_status == 'Leave') ? 'checked' : '' }} type="radio" class="form-check-input" name="attendance_status{{$key}}" id="leave{{$key}}" value="Leave">
                                                    Leave
                                                </label>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                            <div class="form-group text-center mt-4">
                                <input class="btn btn-primary" type="submit" value="Update Attendance">
                            </div>
                    </div>

                </div>

            </div>

        </div> <!-- End Row-->
        </form>
    </div>

@endsection

