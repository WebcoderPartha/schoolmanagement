<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeAttendanceController extends Controller
{

    public function EmployeeAttendanceView(){
        $data['employeeAttendances'] = EmployeeAttendance::select('date')->groupBy('date')->get();

        return view('backend.manage_employee.employee_attendance.employee_attendance_view', $data);

    }

    public function AddEmployeeAttendance(){
        $data['employees'] = Employee::all();
        return view('backend.manage_employee.employee_attendance.employee_attendance_add', $data);

    }

    public function StoreEmployeeAttendance(Request $request){

         $count_employee = count($request->employee_id);

        for ($i = 0; $i < $count_employee; $i++){

            $attendance_status = 'attendance_status'.$i;
            $attendance = new EmployeeAttendance();
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->date = date('d-m-Y', strtotime($request->date));
            $attendance->attendance_status = $request->$attendance_status;
            $attendance->save();

        } // end for loop

        Toastr::success('Employee attendance inserted successfully!');
        return Redirect::route('employees.attendance_view');

    }

}
