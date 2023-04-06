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
                                    <td><b>SL</b></td>
                                    <td><b>Employee ID</b></td>
                                    <td><b>Employee Name</b></td>
                                    <td><b>Attendance Status</b></td>
                                </tr>
                                @foreach($attendances as $key => $attendance)
                                <tr id="employee-{{$attendance->employee_id}}">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $attendance->employee->id_number }}</td>
                                    <td>{{$attendance->employee->name}}</td>
                                    <td>{{$attendance->attendance_status}}</td>
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

