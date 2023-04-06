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
</style>
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                       <h4> Employee Attendance</h4>
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
                                <tr>
                                    <td>Present</td>
                                    <td>Absent</td>
                                    <td>Leave</td>
                                </tr>
                                @foreach($employees as $key => $employee)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $employee->id_number }}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>partha</td>
                                    <td>partha</td>
                                    <td>partha</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

@endsection

