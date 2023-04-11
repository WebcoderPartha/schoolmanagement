<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $data['employeesAttend'] = EmployeeAttendance::with('employee')->select('employee_id')->groupBy('employee_id')->where('date', 'LIKE', '%'.date('m-Y', strtotime($request->date)).'%')->get();
        return view('backend.accounts.employee_salary.employee_salary_add', $data);

    }

    public function StoreEmployeeSalary(Request $request){

        AccountEmployeeSalary::where('date', date('F, Y', strtotime($request->date)))->delete();
        if ($request->checkBox !== NULL){

            $count = count($request->checkBox);

            for($i = 0; $i < $count; $i++){

                $AccSalEmployee = new AccountEmployeeSalary();
                $AccSalEmployee->employee_id = $request->employee_id[$i];
                $AccSalEmployee->date = date('F, Y', strtotime($request->date));
                $AccSalEmployee->amount = $request->amount[$i];
                $AccSalEmployee->save();

            }

        }

        Toastr::success('Employee salary added to account');
        return Redirect::route('accounts.employee_salaries_view');

    }


}
