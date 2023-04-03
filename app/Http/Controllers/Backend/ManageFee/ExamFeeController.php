<?php

namespace App\Http\Controllers\Backend\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\ExamFee;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExamFeeController extends Controller
{

    public function ExamFeeView(){

        $data['exams'] = ExamFee::with('class', 'year', 'exam')->select(['year_id', 'exam_type_id'])->groupBY(['year_id', 'exam_type_id'])->get();
        return view('backend.manage_fee.exam_fee.exam_fee_view', $data);

    }

    public function ExamFeeAdd(){
        $data['years']      = StudentYear::all();
        $data['classes']    = StudentClass::all();
        $data['examTypes']     = ExamType::all();
        return view('backend.manage_fee.exam_fee.exam_fee_add', $data);
    }

    public function ExamFeeStore(Request $request){
        $this->validate($request,[
            'year_id' => 'required',
            'class_id' => 'required',
            'class_id.*' => 'required',
            'fee_amount.*' => 'required',
            'fee_amount' => 'required',
            'exam_type_id.*' => 'required',
            'exam_type_id' => 'required',
        ]);


        $class_id = $request->class_id;
        $uniqueClass = count(array_unique($class_id));
        $count = count($class_id);

        if ($uniqueClass < $count){

            Toastr::warning('Same class cannot be added!');
            return Redirect::back();

        }else{

            for($i = 0; $i < $count; $i++){

                $examFee = new ExamFee();
                $examFee->year_id = $request->year_id;
                $examFee->class_id = $request->class_id[$i];
                $examFee->fee_amount = $request->fee_amount[$i];
                $examFee->exam_type_id = $request->exam_type_id[$i];
                $examFee->save();

            }

        }

        Toastr::success('Exam Fee added successfully');
        return Redirect::route('exam.fees.view');
    }
    public function ExamFeeEdit($year_id, $exam_type_id){
        $data['exams'] = ExamFee::where(['year_id' =>$year_id, 'exam_type_id' => $exam_type_id])->get();
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();

        return view('backend.manage_fee.exam_fee.exam_fee_edit', $data);
    }

    public function ExamFeeUpdate(Request $request, $year_id, $exam_type_id){
        $this->validate($request,[
            'year_id' => 'required',
            'class_id' => 'required',
            'class_id.*' => 'required',
            'fee_amount.*' => 'required',
            'fee_amount' => 'required',
            'exam_type_id.*' => 'required',
            'exam_type_id' => 'required',
        ]);


        $class_id = $request->class_id;
        $uniqueClass = count(array_unique($class_id));
        $count = count($class_id);

        if ($uniqueClass < $count){

            Toastr::warning('Same class cannot be added!');
            return Redirect::back();

        }else{

            $oldExamFee = ExamFee::where([
                'year_id' =>$year_id,
                'exam_type_id' => $exam_type_id
            ])->delete();

            for($i = 0; $i < $count; $i++){


                $examFee = new ExamFee();
                $examFee->year_id = $request->year_id;
                $examFee->class_id = $request->class_id[$i];
                $examFee->fee_amount = $request->fee_amount[$i];
                $examFee->exam_type_id = $request->exam_type_id[$i];
                $examFee->save();

            }

        }

        Toastr::success('Exam fee updated successfully');
        return Redirect::route('exam.fees.view');

    }

    public function ExamFeeDetails($year_id, $exam_type_id){

        $data['examFees'] = ExamFee::with(['class', 'year', 'exam'])->where([
            'year_id' =>$year_id,
            'exam_type_id' => $exam_type_id
        ])->get();
        return view('backend.manage_fee.exam_fee.exam_fee_details', $data);
    }

    public function ExamFeeDelete($year_id, $exam_type_id, $class_id){
        $delete =  ExamFee::where([
            'year_id' =>$year_id,
            'exam_type_id' => $exam_type_id,
            'class_id' => $class_id
        ])->delete();

        Toastr::success('Exam fee deleted successfully');
        return Redirect::back();
    }

    public function monthlyFeesWisePDF($year_id, $exam_type_id){

    }

}
