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
use Illuminate\Http\Request;

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
        $date = $request->date;


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

            return $data['monthlyFee'] = MonthlyFee::where([
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
        }else if($request->choose_fee === 'exam_fee'){

            return $data['studentfees'] = ExamFee::with('year', 'class')->where([
                'class_id' => $class_id,
                'year_id' => $year_id
            ])->get();

        }


    }


}
