<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Barryvdh\DomPDF\Facade\Pdf;
use http\Env\Response;
use Illuminate\Http\Request;

class MonthlySalaryController extends Controller
{

    public function MonthlySalaryView(){

        return view('backend.manage_employee.monthly_salary.monthly_salary_view');

    }

    public function SearchMonthlySalary(Request $request){


        $date = date('m-Y', strtotime($request->date));

        $data['attendEmployees'] = EmployeeAttendance::with('employee')->select('employee_id')->groupBy('employee_id')->where('date', 'LIKE', '%'.$date.'%')->get();

        return view('backend.manage_employee.monthly_salary.monthly_salary_view', $data);

    }

    public function MonthlySalaryPaySlip($date, $employee_id){

        $date = date('m-Y', strtotime($date));


        $data['attendEmployee'] = EmployeeAttendance::with('employee')->where('date', 'LIKE', '%'.$date.'%')->where('employee_id', $employee_id)->first();

        $employeePresent = EmployeeAttendance::with('employee')->where('date', 'LIKE', '%'.$date.'%')->where('employee_id', $employee_id)->where('attendance_status', 'Present')->count();

        $basicSalary = $data['attendEmployee']->employee->salary;
        $perDaySalary = (float)$basicSalary/30;
        $data['thisMonthSalary'] = (float)$perDaySalary*$employeePresent;

        $pdf = Pdf::loadView('backend.pdf.employee_monthly_payslip', $data);
        return $pdf->stream($data['attendEmployee']->employee->id_number.'-'.date('F', strtotime($data['attendEmployee']->date)).'.pdf');

    }

}
