<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SalaryController extends Controller
{
    public function SalaryViews(){

        $data['employees'] = Employee::all();
        return view('backend.manage_employee.employee_salary.salary_view', $data);

    }

    public function SalaryIncrement($id){

        $data['employee'] = Employee::find($id);
        return view('backend.manage_employee.employee_salary.salary_increment', $data);
    }

    public function SalaryIncrementStore(Request $request, $id){
        $this->validate($request, [
            'increment_salary' => 'required',
            'effected_salary_date' => 'required'
        ]);

        $employee = Employee::find($id);

        $previous_salary = $employee->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;

        // After increment present salary
        $employee->salary = $present_salary;
        $employee->save();


        // Employee Salary Log
        $salary = new EmployeeSalary;
        $salary->employee_id = $id;
        $salary->previous_salary = $previous_salary;
        $salary->present_salary = $present_salary;
        $salary->increment_salary = $request->increment_salary;
        $salary->effected_salary_date = date('d-m-Y', strtotime($request->effected_salary_date));
        $salary->save();

        Toastr::success('Employee salary increment successfully!');
        return Redirect::route('employees.salary_view');

    }

    public function EmployeeSalaryDetail($id){

        $data['employee_salaries'] = EmployeeSalary::with('employee')->where('employee_id', $id)->get();

        return view('backend.manage_employee.employee_salary.salary_details_by_employee_ID', $data);
    }

    public function EmployeeSalaryPDF($id){

        $data['allData'] = EmployeeSalary::with('employee')->where('employee_id', $id)->get();
        //        return view('backend.pdf.employee_salary_details_pdf', $data);
        $PDF = Pdf::loadView('backend.pdf.employee_salary_details_pdf', $data);
        return $PDF->stream($data['allData'][0]->employee->id_number.'-'.$data['allData'][0]->employee->name.'.pdf');


    }
    public function EmployeeSalaryPDFDownload($id){

        $data['allData'] = EmployeeSalary::with('employee')->where('employee_id', $id)->get();
        //        return view('backend.pdf.employee_salary_details_pdf', $data);
        $PDF = Pdf::loadView('backend.pdf.employee_salary_details_pdf', $data);
        return $PDF->download($data['allData'][0]->employee->id_number.'-'.$data['allData'][0]->employee->name.'.pdf');


    }


}
