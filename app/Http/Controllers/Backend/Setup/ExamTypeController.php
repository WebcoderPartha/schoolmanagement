<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\ExamType;
use Illuminate\Support\Facades\Redirect;

class ExamTypeController extends Controller
{
    public function ExamTypeView(){
        $examTypes = ExamType::all();
        return view('backend.setups.student.exam_type.exam_type_view', compact('examTypes'));

    }

    public function ExamTypeStore(Request $request){

        $this->validate($request, [
            'name' => 'required|string|unique:exam_types,name'
        ]);

        $examType = new ExamType();
        $examType->name = $request->name;
        $examType->save();

        Toastr::success('Exam type added successfully!');
        return Redirect::route('exam_type.view');

    }


    public function ExamTypeEdit($id){
        $examTypes = ExamType::all();
        $examType = ExamType::find($id);
        return view('backend.setups.student.exam_type.exam_type_edit', compact('examType','examTypes'));

    }

    public function ExamTypeUpdate(Request $request, $id){
        $examType = ExamType::find($id);
        $this->validate($request, [
            'name' => 'required|string|unique:exam_types,name,'.$examType->id
        ]);

        $examType->name = $request->name;
        $examType->save();

        Toastr::success('Exam type updated successfully!');
        return Redirect::route('exam_type.view');

    }

    public function ExamTypeDestroy($id){
        $examType = ExamType::find($id);
        $examType->delete();
        Toastr::success('Exam type deleted successfully!');
        return Redirect::route('exam_type.view');
    }

}
