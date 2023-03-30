<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AssignSubjectController extends Controller
{
    public function assignSubjectView(){
        $classes = AssignSubject::with('class')->select('class_id')->groupBy('class_id')->get();
        return view('backend.setups.student.assign_subject.assign_subject_view', compact('classes'));

    }


    public function assignSubjectAdd(){
        $allClasses = StudentClass::all();
        $allSubjects = SchoolSubject::all();
        return view('backend.setups.student.assign_subject.assign_subject_add', compact('allSubjects', 'allClasses'));
    }
    public function assignSubjectStore(Request $request){

        $this->validate($request, [
            'subject_id' => 'required',
            'subject_id.*' => 'required',
            'class_id' => 'required',
            'pass_mark' => 'required',
            'pass_mark.*' => 'required',
            'full_mark' => 'required',
            'full_mark.*' => 'required',
            'subjective_mark' => 'required',
            'subjective_mark.*' => 'required',
        ]);

        $count = count($request->subject_id);

        if ($count != null){

            for ($i = 0; $i < $count ; $i++){
                $assignSubject = new AssignSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $request->subject_id[$i];
                $assignSubject->pass_mark = $request->pass_mark[$i];
                $assignSubject->full_mark = $request->full_mark[$i];
                $assignSubject->subjective_mark = $request->subjective_mark[$i];
                $assignSubject->save();
            }

        }else{
            Toastr::error('Subject must not be empty!');
            return Redirect::back();
        }
        Toastr::success('Assign subject added successfully!');
        return Redirect::route('assign_subject.view');

    }


    public function assignSubjectEdit($class_id){
        $classes = StudentClass::all();
        $allSubject = SchoolSubject::all();
        $assignSubjects = AssignSubject::where('class_id', $class_id)->get();
        return view('backend.setups.student.assign_subject.assign_subject_edit', compact('classes','assignSubjects', 'allSubject'));

    }

    public function assignSubjectUpdate(Request $request, $class_id){

//        $this->validate($request, [
//            'subject_id' => 'required',
//            'class_id' => 'required',
//            'pass_mark' => 'required',
//            'full_mark' => 'required',
//            'subjective_mark' => 'required',
//        ]);

        if ($request->class_id !== NULL ){

            $count = count($request->subject_id);
            $oldClass = AssignSubject::where('class_id', $class_id)->delete();
            for ($i = 0; $i < $count; $i++){
                $assignSubject = new AssignSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $request->subject_id[$i];
                $assignSubject->pass_mark = $request->pass_mark[$i];
                $assignSubject->full_mark = $request->full_mark[$i];
                $assignSubject->subjective_mark = $request->subjective_mark[$i];
                $assignSubject->save();
            }


        }else{
            Toastr::error('Please select class!');
            return Redirect::back();
        }

        Toastr::success('Assign updated successfully!');
        return Redirect::route('assign_subject.view');

    }

    public function assignSubjectClassDetails($class_id){
        $assSubjectsClass = AssignSubject::with('class', 'subject')->where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setups.student.assign_subject.assign_subject_class_details', compact('assSubjectsClass'));
    }

    public function assignSubjectClassDelete($class_id){
        $subject = AssignSubject::where('class_id', $class_id)->delete();
        Toastr::success('Assign subject class deleted successfully!');
        return Redirect::route('assign_subject.view');
    }
    public function assignSubjectDestroy($id){
        $subject = AssignSubject::find($id);
        $subject->delete();
        Toastr::success('Subject deleted successfully!');
        return Redirect::back();
    }


    public function assignClassSubjectListPDF(){

        $data['allData'] = AssignSubject::orderBy('class_id', 'asc')->get()->groupBy('class_id');
        $PDF = Pdf::loadView('backend.pdf.assign_class_subject_list', $data);
        return $PDF->stream('assign_class_subject_list.pdf');
    }

}
