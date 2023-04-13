<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SchoolSubjectController extends Controller
{
    public function SchoolSubjectView(){
        $allSubject = SchoolSubject::all();
        return view('backend.setups.student.school_subject.school_subject_view', compact('allSubject'));

    }

    public function SchoolSubjectStore(Request $request){

        $this->validate($request, [
            'name' => 'required|string|unique:school_subjects,name'
        ]);

        $subject = new SchoolSubject();
        $subject->name = $request->name;
        $subject->save();

        Toastr::success('Subject added successfully!');
        return Redirect::route('school_subject.view');

    }


    public function SchoolSubjectEdit($id){
        $allSubject = SchoolSubject::all();
        $Singlesubject = SchoolSubject::find($id);
        return view('backend.setups.student.school_subject.school_subject_edit', compact('allSubject','Singlesubject'));

    }

    public function SchoolSubjectUpdate(Request $request, $id){
        $subject = SchoolSubject::find($id);
        $this->validate($request, [
            'name' => 'required|string|unique:school_subjects,name,'.$subject->id
        ]);

        $subject->name = $request->name;
        $subject->save();

        Toastr::success('Subject updated successfully!');
        return Redirect::route('school_subject.view');

    }

    public function SchoolSubjectDestroy($id){
        $subject = SchoolSubject::find($id);
        $subject->delete();
        Toastr::success('Subject deleted successfully!');
        return Redirect::route('school_subject.view');
    }

}
