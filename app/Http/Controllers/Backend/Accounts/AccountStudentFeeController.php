<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\Backend\RegistrationFee;
use App\Models\ExamFee;
use App\Models\ExamType;
use App\Models\Month;
use App\Models\MonthlyFee;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountStudentFeeController extends Controller
{
    public function AccountStudentFeeView (){

        $data['studentFees'] = AccountStudentFee::with('year', 'class', 'student')->orderBy('id', 'DESC')->get();

        return view('backend.accounts.student_fees.student_fee_view', $data);

    }

    public function addStudentFees(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['months'] = Month::all();
        $data['examTypes'] = ExamType::all();
        return view('backend.accounts.student_fees.student_fee_add', $data);

    }

    public function SearchStudentFee(Request $request){

        $this->validate($request, [
            'year_id' => 'required',
            'class_id' => 'required',
            'choose_fee' => 'required',
            'date' => 'required'
        ]);

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $data['date'] = $request->date;
        $data['choose_fee'] = $request->choose_fee;


        if ($request->choose_fee === 'registration_fee'){

            $data['registrationFee'] = RegistrationFee::with('year', 'class')->where([
                'student_class_id' => $class_id,
                'student_year_id' => $year_id
            ])->first();

            $data['assignStudents'] = AssignStudent::with('student', 'class', 'year')->where([
                'class_id' => $class_id,
                'year_id' => $year_id
            ])->get();

            $data['years'] = StudentYear::all();
            $data['classes'] = StudentClass::all();
            $data['months'] = Month::all();
            $data['examTypes'] = ExamType::all();
            return view('backend.accounts.student_fees.student_fee_add', $data);

        }else if ($request->choose_fee === 'monthly_fee' && $request->month_id !== NULL){

            $data['monthlyFee'] = MonthlyFee::with('month')->where([
                'student_class_id' => $class_id,
                'student_year_id' => $year_id,
                'month_id' => $request->month_id
            ])->first();


            $data['assignStudents'] = AssignStudent::with('student', 'class', 'year')->where([
                'class_id' => $class_id,
                'year_id' => $year_id
            ])->get();

            $data['years'] = StudentYear::all();
            $data['classes'] = StudentClass::all();
            $data['months'] = Month::all();
            $data['examTypes'] = ExamType::all();

            return view('backend.accounts.student_fees.student_fee_add', $data);


        }else if($request->choose_fee === 'exam_fee' && $request->exam_type_id !== NULL){


             $data['examFee'] = ExamFee::with('exam')->where([
                'class_id' => $class_id,
                'year_id' => $year_id,
                'exam_type_id' => $request->exam_type_id
            ])->first();

            $data['years'] = StudentYear::all();
            $data['classes'] = StudentClass::all();
            $data['months'] = Month::all();
            $data['examTypes'] = ExamType::all();

            $data['assignStudents'] = AssignStudent::with('student', 'class', 'year')->where([
                'class_id' => $class_id,
                'year_id' => $year_id
            ])->get();

            return view('backend.accounts.student_fees.student_fee_add', $data);


        }


    }

    public function StudentFeeStore(Request $request){

        if ($request->choose_fee === 'registration_fee'){

            $delete = AccountStudentFee::where([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'fee_name' => 'Registration',
                'date' => date('m-Y', strtotime($request->date))
            ])->delete();

            if ($request->checkBox !== NULL){
                $countCheckBox = count($request->checkBox);

                for ($i = 0; $i < $countCheckBox; $i++){

                    $AccountStudent = new AccountStudentFee();
                    $AccountStudent->year_id = $request->year_id;
                    $AccountStudent->class_id = $request->class_id;
                    $AccountStudent->fee_name = 'Registration';
                    $AccountStudent->date =  date('m-Y', strtotime($request->date));
                    $AccountStudent->student_id = $request->student_id[$i];
                    $AccountStudent->amount = $request->amount[$i];
                    $AccountStudent->save();

                }

                Toastr::success('Student registration fee added in account');
                return Redirect::route('accounts.student_fee_view');
            }

            Toastr::success('Student fee removed in account');
            return Redirect::route('accounts.student_fee_view');


        }else if($request->choose_fee === 'monthly_fee'){

            $delete = AccountStudentFee::where([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'fee_name' => $request->fee_name,
                'date' => date('m-Y', strtotime($request->date))
            ])->delete();

            if ($request->checkBox !== NULL){
                $countCheckBox = count($request->checkBox);

                for ($i = 0; $i < $countCheckBox; $i++){

                    $AccountStudent = new AccountStudentFee();
                    $AccountStudent->year_id = $request->year_id;
                    $AccountStudent->class_id = $request->class_id;
                    $AccountStudent->fee_name = $request->fee_name;
                    $AccountStudent->date =  date('m-Y', strtotime($request->date));
                    $AccountStudent->student_id = $request->student_id[$i];
                    $AccountStudent->amount = $request->amount[$i];
                    $AccountStudent->save();

                }

                Toastr::success('Student monthly fee added in account');
                return Redirect::route('accounts.student_fee_view');
            }

            Toastr::success('Student monthly fee removed in account');
            return Redirect::route('accounts.student_fee_view');


        } else if($request->choose_fee === 'exam_fee'){

            $delete = AccountStudentFee::where([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'fee_name' => $request->fee_name,
                'date' => date('m-Y', strtotime($request->date))
            ])->delete();

            if ($request->checkBox !== NULL){
                $countCheckBox = count($request->checkBox);

                for ($i = 0; $i < $countCheckBox; $i++){

                    $AccountStudent = new AccountStudentFee();
                    $AccountStudent->year_id = $request->year_id;
                    $AccountStudent->class_id = $request->class_id;
                    $AccountStudent->fee_name = $request->fee_name;
                    $AccountStudent->date =  date('m-Y', strtotime($request->date));
                    $AccountStudent->student_id = $request->student_id[$i];
                    $AccountStudent->amount = $request->amount[$i];
                    $AccountStudent->save();

                }

                Toastr::success('Student exam fee added in account');
                return Redirect::route('accounts.student_fee_view');
            }

            Toastr::success('Student exam fee removed in account');
            return Redirect::route('accounts.student_fee_view');
        }


    }


}
