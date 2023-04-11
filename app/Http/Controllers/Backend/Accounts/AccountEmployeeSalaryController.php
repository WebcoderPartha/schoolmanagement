<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class AccountEmployeeSalaryController extends Controller
{


    public function AccountEmployeeSalariesView(){
        $data['accountEmployees'] = AccountEmployeeSalary::with('employee')->orderBy('id', 'DESC')->get();
        return view('backend.accounts.employee_salary.employee_salary_view', $data);

    }

    public function AccountEmployeeSalariesAdd(){

        return view('backend.accounts.employee_salary.employee_salary_add');

    }

    public function SearchEmployeeSalary(Request $request){

        $this->validate($request, [
            'date' => 'required'
        ]);

        $data['date'] = $request->date;
        $data['employeesAttend'] = EmployeeAttendance::with('employee')->select('employee_id')->groupBy('employee_id')->where('date', 'LIKE', '%'.date('m', strtotime($request->date)).'%')->get();
        return view('backend.accounts.employee_salary.employee_salary_add', $data);

    }

    public function StoreEmployeeSalary(Request $request){



    }


}
