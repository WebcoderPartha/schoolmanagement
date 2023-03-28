<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentClassController extends Controller
{

    public function StudentClassView(){
        $studentClasses = StudentClass::all();
        return view('backend/setups/student/student_class_view', compact('studentClasses'));
    }

//    public function StudentClassAdd(){
//        return view('backend/setups/student/student_class_add');
//    }

    public function StudentClassStore(Request $request){
        $this->validate($request, [
            'class_name' => 'required|unique:student_classes,class_name'
        ]);

        $studentClass = new StudentClass();
        $studentClass->class_name = $request->class_name;
        $studentClass->save();

        Toastr::success('Student class added successfully!');
        return Redirect::route('student.class.view');

    }

    public function StudentClassEdit($id)
    {

        $studentClass = StudentClass::find($id);
        return view('backend/setups/student/student_class_edit', compact('studentClass'));

    }

    public function StudentClassUpdate(Request $request, $id){

        $studentClass = StudentClass::find($id);
        $this->validate($request, [
            'class_name' => 'required|unique:student_classes,class_name,'.$studentClass->id
        ]);

        $studentClass->class_name = $request->class_name;
        $studentClass->save();

        Toastr::success('Student class updated successfully!');
        return Redirect::route('student.class.view');

    }

    public function StudentClassDestroy($id){

        $studentClass = StudentClass::find($id);
        $studentClass->delete();
        return Redirect::route('student.class.view');

    }


}
