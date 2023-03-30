<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AssignSubjectController extends Controller
{
    public function assignSubjectView(){
        $classes = AssignSubject::with('student_class')->select('class_id')->groupBy('student_class')->get();
        return view('backend.setups.student.assign_subject.assign_subject_view', compact('classes'));

    }

    public function assignSubjectStore(Request $request){

        $this->validate($request, [
            'subject_id' => 'required',
            'class_id' => 'required',
            'pass_mark' => 'required',
            'full_mark' => 'required',
            'subjective_mark' => 'required',
        ]);

        $count_class = count($request->class_id);

        if ($count_class !== NULL){

            for ($i = 0; $i < $count_class; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->subject_id = $request->subject_id;
                $assign_subject->class_id = $request->class_id[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }

        }else{
            Toastr::error('Please select class!');
            return Redirect::back();
        }

        Toastr::success('Assign subject added successfully!');
        return Redirect::route('assign_subject.view');

    }


    public function assignSubjectEdit($class_id){
        $classes = StudentClass::all();
        $assignSubjects = AssignSubject::where('class_id', $class_id)->get();
        return view('backend.setups.student.school_subject.school_subject_edit', compact('classes','assignSubjects'));

    }

    public function assignSubjectUpdate(Request $request, $class_id){

        $this->validate($request, [
            'subject_id' => 'required',
            'class_id' => 'required',
            'pass_mark' => 'required',
            'full_mark' => 'required',
            'subjective_mark' => 'required',
        ]);




        Toastr::success('Subject updated successfully!');
        return Redirect::route('school_subject.view');

    }

    public function assignSubjectDestroy($id){
        $subject = SchoolSubject::find($id);
        $subject->delete();
        Toastr::success('Subject deleted successfully!');
        return Redirect::route('school_subject.view');
    }

}
