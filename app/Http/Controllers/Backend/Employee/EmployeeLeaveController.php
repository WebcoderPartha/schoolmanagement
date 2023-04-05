<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeLeaveController extends Controller
{
    public function EmployeeLeaveView(){

        $data['employees'] = EmployeeLeave::with('leave', 'employee')->orderBy('id', 'desc')->get();

        return view('backend.manage_employee.employee_leave.employee_leave_view', $data);

    }

    public function EmployeeLeaveAdd(){

        $data['employees'] = Employee::all();
        $data['leave_purposes'] = LeavePurpose::all();

        return view('backend.manage_employee.employee_leave.employee_leave_add', $data);

    }


    public function EmployeeLeaveStore(Request $request){
        $this->validate($request, [
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_purpose_id' => 'required',
        ]);

        if ($request->name !== NULL){

            $leavePurpose = new LeavePurpose();
            $leavePurpose->name = $request->name;
            $leavePurpose->save();

            $employeeLeave = new EmployeeLeave();
            $employeeLeave->employee_id = $request->employee_id;
            $employeeLeave->start_date = date('d-m-Y', strtotime($request->start_date));
            $employeeLeave->end_date = date('d-m-Y', strtotime($request->end_date));
            $employeeLeave->leave_purpose_id = $leavePurpose->id;
            $employeeLeave->save();


            Toastr::success('Employee leave added successfully!');
            return Redirect::route('employees.leave_view');

        }else{

            $employeeLeave = new EmployeeLeave();
            $employeeLeave->employee_id = $request->employee_id;
            $employeeLeave->start_date = date('d-m-Y', strtotime($request->start_date));
            $employeeLeave->end_date = date('d-m-Y', strtotime($request->end_date));
            $employeeLeave->leave_purpose_id = $request->leave_purpose_id;
            $employeeLeave->save();
            Toastr::success('Employee leave added successfully!');
            return Redirect::route('employees.leave_view');

        }



    }


}
