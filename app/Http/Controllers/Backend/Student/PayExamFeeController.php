<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamFee;
use App\Models\ExamType;
use App\Models\Month;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class PayExamFeeController extends Controller
{

    public function ExamFeeSearchView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();
        $year_id = StudentYear::orderBy('id')->first()->id;
        $class_id = StudentClass::orderBy('id')->first()->id;

         return view('backend.pay_exam_fee.pay_exam_fee_view', $data);
    }
    public function payExamFeeSearch(Request $request){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();


        $data['examFees'] = ExamFee::where([
            'class_id' => $request->class_id,
            'year_id' => $request->year_id,
            'exam_type_id' => $request->exam_type_id
        ])->first();

        $data['students'] = AssignStudent::with('student','year')->where([
            'class_id' => $request->class_id,
            'year_id' => $request->year_id
        ])->get();

        return view('backend.pay_exam_fee.pay_exam_fee_search', $data);
    }
    public function payExamFeePDF($year_id, $exam_type_id, $class_id, $student_id){

    }

}
