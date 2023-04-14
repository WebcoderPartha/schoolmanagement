<?php

namespace App\Http\Controllers\Backend\ManageReport;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeAttendantReport extends Controller
{

    public function EmployeeAttendantReport(){

        $data['employees'] = Employee::all();
        return view('backend.manage_reports.employee_attendant_report.employee_attendant', $data);

    }


    public function EmployeeAttendantReportView(Request $request){

        $this->validate($request, [
            'employee_id' => 'required',
            'date' => 'required'
        ]);

        $employee_id = $request->employee_id;
        $date = date('m-Y', strtotime($request->date));

        $attendant = EmployeeAttendance::where('employee_id', $employee_id)->where('date', 'LIKE', '%'.$date.'%')->first();

        if ($attendant == true){

            $data['attendants'] = EmployeeAttendance::with('employee')->where('employee_id', $employee_id)->where('date', 'LIKE', '%'.$date.'%')->get();
             $data['presentCount'] = EmployeeAttendance::where('attendance_status', 'Present')->where('employee_id', $employee_id)->where('date', 'LIKE', '%'.$date.'%')->get()->count();

             $data['absentCount'] = EmployeeAttendance::where('attendance_status', 'Absent')->where('employee_id', $employee_id)->where('date', 'LIKE', '%'.$date.'%')->get()->count();

            $data['date'] = date('F, Y', strtotime($request->date));

            return view('backend.manage_reports.employee_attendant_report.employee_attendant_report_view', $data);

        }else{

            Toastr::error('Attendant report not found!');
            return Redirect::back();

        }

    }


}
