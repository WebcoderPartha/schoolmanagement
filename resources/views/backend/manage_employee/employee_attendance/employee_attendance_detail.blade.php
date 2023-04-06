@extends('layout.admin_master')
@section('title')
    Employee Attendance Detail
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
    table.table.attendance_count th {
        border: 1px solid #00c8bf;
        text-align: center;
        background: #ddd;
        font-weight: 500;
    }
</style>
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                       <h4> Employee Attendance Detail</h4>
                       <h5> {{date('d-F-Y', strtotime($attendances[0]->date))}}</h5>
                        <hr>
                        <div class="col-4 mx-auto ">
                            <div class="table-respnsive text-center">
                            <table class="table attendance_count">
                                <tr>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Leave</th>
                                </tr>
                                <tr>
                                    <td>{{ $present }}</td>
                                    <td>{{ $absent }}</td>
                                    <td>{{ $leave }}</td>
                                </tr>
                            </table>
                            </div>
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

                    </div>

                </div>

            </div>

        </div> <!-- End Row-->
    </div>

@endsection

