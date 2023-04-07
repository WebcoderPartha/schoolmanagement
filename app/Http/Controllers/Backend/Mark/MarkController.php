<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\Mark;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class MarkController extends Controller
{

    public function MarkView(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();

        return view('backend.manage_mark.mark_view', $data);

    }

    public function ClassSubjectGet(Request $request){

        $data['subjects'] = AssignSubject::with('subject')->where('class_id', $request->class_id)->get();
        return Response::json($data);
    }

    public function GetAssignStudent(Request $request){
        $data = AssignStudent::with('student', 'year', 'class')->where([
            'class_id' => $request->class_id,
            'year_id' => $request->year_id
        ])->get();

        return Response::json($data);

    }

    public function AssignStudentMarkStore(Request $request){

        if ($request->year_id == NULL){

            Toastr::error('Please select year!');
            return Redirect::back();

        }else if($request->class_id == NULL){

            Toastr::error('Please select year!');
            return Redirect::back();

        }else if($request->subject_id == NULL){

            Toastr::error('Please select subject!');
            return Redirect::back();

        }else if($request->exam_type_id == NULL){

            Toastr::error('Please select exam type!');
            return Redirect::back();

        }else if($request->marks == NULL){

            Toastr::error('Mark must not be empty!');
            return Redirect::back();

        }else{

            $count_student_id = count($request->student_id);

            for ($i = 0; $i < $count_student_id; $i++){

                $marks = new Mark();
                $marks->student_id = $request->student_id[$i];
                $marks->id_number = $request->id_number[$i];
                $marks->year_id = $request->year_id;
                $marks->class_id = $request->class_id;
                $marks->exam_type_id = $request->exam_type_id;
                $marks->subject_id = $request->subject_id;
                $marks->marks = $request->marks[$i];
                $marks->save();

            } // end for loop

        } //  end if else

        Toastr::success('Marks entry successfylly!');
        return Redirect::back();
    }


}
