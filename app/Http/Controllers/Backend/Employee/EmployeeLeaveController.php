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

    public function EmployeeLeaveEdit($employee_id){
        $data['employees'] = Employee::all();
        $data['leave_purposes'] = LeavePurpose::all();
        $data['employeeLeave'] = EmployeeLeave::where('employee_id', $employee_id)->first();

        return view('backend.manage_employee.employee_leave.employee_leave_edit', $data);
    }

    public function EmployeeLeaveUpdate(Request $request, $employee_id){

        if ($request->name !== NULL){

            $leavePurpose = new LeavePurpose();
            $leavePurpose->name = $request->name;
            $leavePurpose->save();
            $leave_purpose_id = $leavePurpose->id;

            $leaveEmployee = EmployeeLeave::where('employee_id', $employee_id)->first();
            $leaveEmployee->employee_id = $request->employee_id;
            $leaveEmployee->leave_purpose_id = $leave_purpose_id;
            $leaveEmployee->start_date = $request->start_date;
            $leaveEmployee->end_date = $request->end_date;
            $leaveEmployee->save();

            Toastr::success('Employee leave updated successfully!');
            return Redirect::route('employees.leave_view');


        }else{

            $leaveEmployee = EmployeeLeave::where('employee_id', $employee_id)->first();
            $leaveEmployee->employee_id = $request->employee_id;
            $leaveEmployee->leave_purpose_id = $request->leave_purpose_id;
            $leaveEmployee->start_date = $request->start_date;
            $leaveEmployee->end_date = $request->end_date;
            $leaveEmployee->save();

            Toastr::success('Employee leave updated successfully!');
            return Redirect::route('employees.leave_view');

        }
    }

    public function EmployeeLeaveDelete($employee_id){

        $employeeLeave = EmployeeLeave::where('employee_id', $employee_id)->first();
        $employeeLeave->delete();
        Toastr::success('Employee leave deleted successfully!');
        return Redirect::route('employees.leave_view');
    }


}
