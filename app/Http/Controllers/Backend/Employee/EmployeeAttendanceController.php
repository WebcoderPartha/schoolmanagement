<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function Ramsey\Collection\offer;

class EmployeeAttendanceController extends Controller
{

    public function EmployeeAttendanceView(){
        $data['employeeAttendances'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();

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

    public function EditEmployeeAttendance($date){

//        $data['employees'] = Employee::all();
        $data['attendances'] = EmployeeAttendance::where('date', date('d-m-Y', strtotime($date)))->get();
        return view('backend.manage_employee.employee_attendance.employee_attendance_edit', $data);

    }

    public function UpdateEmployeeAttendance(Request $request, $date){

        $count_employee = count($request->employee_id);
        $oldAttendance = EmployeeAttendance::where('date', date('d-m-Y', strtotime($date)))->delete();

        for ($i = 0; $i < $count_employee; $i++){

            $attendance_status = 'attendance_status'.$i;
            $attendance = new EmployeeAttendance();
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->date = date('d-m-Y', strtotime($request->date));
            $attendance->attendance_status = $request->$attendance_status;
            $attendance->save();


        } // End for loop
        Toastr::success('Employee attendance updated successfully!');
        return Redirect::route('employees.attendance_view');

    }

    public function DetailEmployeeAttendance($date){

        $data['attendances'] = EmployeeAttendance::where('date', date('d-m-Y', strtotime($date)))->get();

        // Present Count
        $data['present'] = EmployeeAttendance::where([
            'date' => date('d-m-Y', strtotime($date)),
            'attendance_status' => 'Present'
        ])->count();

        // Absent Count
        $data['absent'] = EmployeeAttendance::where([
            'date' => date('d-m-Y', strtotime($date)),
            'attendance_status' => 'Absent'
        ])->count();

        // Leave Count
        $data['leave'] = EmployeeAttendance::where([
            'date' => date('d-m-Y', strtotime($date)),
            'attendance_status' => 'Leave'
        ])->count();

        return view('backend.manage_employee.employee_attendance.employee_attendance_detail', $data);
    }

}
