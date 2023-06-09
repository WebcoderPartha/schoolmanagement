<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\Mark;
use App\Models\MarksGrade;
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

            $existMark = Mark::where([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'exam_type_id' => $request->exam_type_id,
            ])->get();

            if (count($existMark) > 0){

                Toastr::warning('This Subject mark already added!');
                return Redirect::back();

            }else{


                $count_student_id = count($request->student_id);

                for ($i = 0; $i < $count_student_id; $i++){


                    $gradePoint = MarksGrade::where('start_marks', '<=', $request->marks[$i])->where('end_marks', '>=', $request->marks[$i])->first();

                    $marks = new Mark();
                    $marks->student_id = $request->student_id[$i];
                    $marks->id_number = $request->id_number[$i];
                    $marks->year_id = $request->year_id;
                    $marks->class_id = $request->class_id;
                    $marks->exam_type_id = $request->exam_type_id;
                    $marks->subject_id = $request->subject_id;
                    $marks->marks_grade_point = $gradePoint->grade_point;
                    $marks->marks = trim($request->marks[$i]);
                    $marks->save();

                } // end for loop
            }



        } //  end if else

        Toastr::success('Marks entry successfully!');
        return Redirect::back();
    }

    public function MarkEdit(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();

        return view('backend.manage_mark.mark_edit', $data);

    }

    public function GetEditMarks(Request $request){

        $data = Mark::with('student','year', 'class')->where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'exam_type_id' => $request->exam_type_id,
        ])->get();

        return Response::json($data);

    }

    public function MarkUpdate(Request $request){

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

                $delete = Mark::where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id,
                    'exam_type_id' => $request->exam_type_id,
                    'student_id' => $request->student_id[$i],
                    'id_number' => $request->id_number[$i]
                ])->delete();

                $gradePoint = MarksGrade::where('start_marks', '<=', $request->marks[$i])->where('end_marks', '>=', $request->marks[$i])->first();


                $marks = new Mark();
                $marks->student_id = $request->student_id[$i];
                $marks->id_number = $request->id_number[$i];
                $marks->year_id = $request->year_id;
                $marks->class_id = $request->class_id;
                $marks->exam_type_id = $request->exam_type_id;
                $marks->subject_id = $request->subject_id;
                $marks->marks_grade_point = $gradePoint->grade_point;
                $marks->marks = trim($request->marks[$i]);
                $marks->save();

            } // end for loop

        } //  end if else

        Toastr::success('Marks updated successfully!');
        return Redirect::back();

    }


}
