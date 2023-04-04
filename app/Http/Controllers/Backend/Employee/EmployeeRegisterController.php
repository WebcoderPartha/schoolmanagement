<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EmployeeRegisterController extends Controller
{
    public function EmployeeViews(){

        $data['employees'] = Employee::with('designation')->orderBy('id', 'desc')->get();
        return view('backend.manage_employee.employees_view', $data);
    }

    public function RegisterEmployee(){

        $data['designations'] = Designation::all();
        return view('backend.manage_employee.employee_register', $data);

    }

    public function RegisterEmployeeStore(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'designation_id' => 'required',
            'joining_date' => 'required',
            'salary' => 'required'
        ]);

        $id_number = IdGenerator::generate([
            'table' => 'employees',
            'field' => 'id_number',
            'length' => 8,
            'prefix' => date('ym')
        ]);

//        return date('d-m-Y', strtotime($request->date_of_birth));
        $randomPassword = Str::random(6);

        if ($request->file('image')){

            $image = $request->file('image');
            $imageName = 'employee-'.$id_number.'.'.$image->getClientOriginalExtension();
            $directory = 'uploads/employee/';
            Image::make($image)->resize(300, 300)->save($directory.$imageName);

            // Register Employee
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->father_name = $request->father_name;
            $employee->mother_name = $request->mother_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->date_of_birth = date('d-m-Y', strtotime($request->date_of_birth));
            $employee->gender = $request->gender;
            $employee->religion = $request->religion;
            $employee->address = $request->address;
            $employee->id_number = $id_number;
            $employee->password = Hash::make($randomPassword);
            $employee->save_password = $randomPassword;
            $employee->designation_id = $request->designation_id;
            $employee->joining_date = date('d-m-Y', strtotime($request->joining_date));
            $employee->salary = $request->salary;
            $employee->image = $directory.$imageName;
            $employee->save();

            // Employee Salary
            $employSalary = new EmployeeSalary();
            $employSalary->employee_id = $employee->id;
            $employSalary->previous_salary = $request->salary;
            $employSalary->present_salary = $request->salary;
            $employSalary->increment_salary = '0';
            $employSalary->effected_salary = date('d-m-Y', strtotime($request->joining_date));
            $employSalary->save();


            Toastr::success('Employee registration successfully');
            return Redirect::route('employees.view');

        }else{

            // Register Employee
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->father_name = $request->father_name;
            $employee->mother_name = $request->mother_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->date_of_birth = date('d-M-Y', strtotime($request->date_of_birth));
            $employee->gender = $request->gender;
            $employee->religion = $request->religion;
            $employee->address = $request->address;
            $employee->id_number = $id_number;
            $employee->password = Hash::make($randomPassword);
            $employee->save_password = $randomPassword;
            $employee->designation_id = $request->designation_id;
            $employee->joining_date = date('d-m-Y', strtotime($request->joining_date));
            $employee->salary = $request->salary;
            $employee->save();

            // Employee Salary
            $employSalary = new EmployeeSalary();
            $employSalary->employee_id = $employee->id;
            $employSalary->previous_salary = $request->salary;
            $employSalary->present_salary = $request->salary;
            $employSalary->increment_salary = '0';
            $employSalary->effected_salary = date('d-M-Y', strtotime($request->joining_date));
            $employSalary->save();


            Toastr::success('Employee registration successfully');
            return Redirect::route('employees.view');

        }

    } // End Method


    public function EmployeeEdit($id_number){
        $data['designations'] = Designation::all();
        $data['employee'] = Employee::where('id_number', $id_number)->first();
        return view('backend.manage_employee.employee_edit', $data);
    }

    public function EmployeeUpdate(Request $request, $id_number){

        $this->validate($request, [
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'designation_id' => 'required',
        ]);

        $employee = Employee::where('id_number', $id_number)->first();

        if ($request->file('image')){

            $image = $request->file('image');
            $imageName = 'employee-'.$employee->id_number.'.'.$image->getClientOriginalExtension();
            $directory = 'uploads/employee/';
            Image::make($image)->resize(300, 300)->save($directory.$imageName);


            if ($employee->image !== NULL){
                if (file_exists(public_path($employee->image))){
                    unlink(public_path($employee->image));
                }
            }

            $employee->name = $request->name;
            $employee->father_name = $request->father_name;
            $employee->mother_name = $request->mother_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->date_of_birth = date('d-M-Y', strtotime($request->date_of_birth));
            $employee->gender = $request->gender;
            $employee->religion = $request->religion;
            $employee->address = $request->address;
            $employee->id_number = $id_number;
            $employee->designation_id = $request->designation_id;
            $employee->image = $directory.$imageName;
            $employee->save();

            Toastr::success('Employee updated registration successfully');
            return Redirect::route('employees.view');

        }else{

            $employee->name = $request->name;
            $employee->father_name = $request->father_name;
            $employee->mother_name = $request->mother_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->date_of_birth = date('d-M-Y', strtotime($request->date_of_birth));
            $employee->gender = $request->gender;
            $employee->religion = $request->religion;
            $employee->address = $request->address;
            $employee->id_number = $id_number;
            $employee->designation_id = $request->designation_id;
            $employee->save();



            Toastr::success('Employee updated registration successfully');
            return Redirect::route('employees.view');
        }


    }

    public function EmployeeDelete($id_number){

        $employee = Employee::where('id_number', $id_number)->first();
        $employee_salary = EmployeeSalary::where('employee_id', $employee->id)->first();

        if ($employee->image !== NULL){

            if (file_exists(public_path($employee->image))) {

                unlink(public_path($employee->image));
                $employee->delete();
                $employee_salary->delete();
                Toastr::success('Employee deleted successfully');
                return Redirect::route('employees.view');

            }else{

                $employee->delete();
                $employee_salary->delete();
                Toastr::success('Employee deleted successfully');
                return Redirect::route('employees.view');

            }

        }else{

            $employee->delete();
            $employee_salary->delete();
            Toastr::success('Employee deleted successfully');
            return Redirect::route('employees.view');

        }

    }

    public function EmployeeDetail($id_number){
        $data['employee'] = Employee::where('id_number', $id_number)->first();
        $data['image_path'] = $data['employee']->image;
        $data['image'] = base64_encode(file_get_contents(public_path($data['image_path'])));

        $pdf = Pdf::loadView('backend.pdf.employee_detail_get_by_id', $data);
        return $pdf->stream($data['employee']->id_number.'.pdf');
    }

    public function EmployeeIDCard($id_number){
        $data['employee'] = Employee::where('id_number', $id_number)->first();
        $data['image_path'] = $data['employee']->image;
        $data['image'] = base64_encode(file_get_contents(public_path($data['image_path'])));
//        return view('backend.pdf.employee_id_card', $data);
        $pdf = Pdf::loadView('backend.pdf.employee_id_card', $data);
        return $pdf->stream($data['employee']->id_number.'.pdf');
    }


}
