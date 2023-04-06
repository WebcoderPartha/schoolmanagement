<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{

    public function EmployeeAttendanceView(){
        $data['employeeAttendances'] = EmployeeAttendance::with('employee')->select('date')->groupBy('date')->get();

        return view('backend.manage_employee.employee_attendance.employee_attendance_view', $data);

    }

    public function AddEmployeeAttendance(){
        $data['employees'] = Employee::all();
        return view('backend.manage_employee.employee_attendance.employee_attendance_add', $data);

    }

}
