<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    public function EmployeeLeaveView(){

        $data['employees'] = EmployeeLeave::with('leave')->orderBy('id', 'desc')->get();

        return view('backend.manage_employee.employee_leave.employee_leave_view', $data);

    }

    public function EmployeeLeaveAdd(){

        $data['employees'] = Employee::all();
        $data['leave_purposes'] = LeavePurpose::all();

        return view('backend.manage_employee.employee_leave.employee_leave_add', $data);

    }
}
