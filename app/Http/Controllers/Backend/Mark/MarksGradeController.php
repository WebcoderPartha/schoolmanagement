<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MarksGradeController extends Controller
{

    public function GradeView(){

        $data['grades'] = MarksGrade::all();
        return view('backend.manage_grade.grade_view', $data);

    }

    public function GradeAdd(){

        return view('backend.manage_grade.grade_add');

    }


    public function GradeStore(Request $request){

        $this->validate($request, [
            'grade_name' => 'required|unique:marks_grades,grade_name',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',
        ]);

        $grade = new MarksGrade();
        $grade->grade_name = $request->grade_name;
        $grade->grade_point = $request->grade_point;
        $grade->start_marks = $request->start_marks;
        $grade->end_marks = $request->end_marks;
        $grade->start_point = $request->start_point;
        $grade->end_point = $request->end_point;
        $grade->remarks = $request->remarks;
        $grade->save();

        Toastr::success('Marks grade added successfully!');
        return Redirect::route('grade.view.all');
    }

    public function GradeEdit($id){
        $data['grade'] = MarksGrade::find($id);
        return view('backend.manage_grade.grade_edit', $data);
    }

    public function GradeUpdate(Request $request, $id){

        $grade = MarksGrade::find($id);

        $this->validate($request, [
            'grade_name' => 'required|unique:marks_grades,grade_name,'.$grade->id,
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',
        ]);

        $grade->grade_name = $request->grade_name;
        $grade->grade_point = $request->grade_point;
        $grade->start_marks = $request->start_marks;
        $grade->end_marks = $request->end_marks;
        $grade->start_point = $request->start_point;
        $grade->end_point = $request->end_point;
        $grade->remarks = $request->remarks;
        $grade->save();

        Toastr::success('Marks grade updated successfully!');
        return Redirect::route('grade.view.all');

    }

    public function GradeDelete($id){

        $grade = MarksGrade::find($id);
        $grade->delete();

        Toastr::success('Marks grade deleted successfully!');
        return Redirect::back();

    }

}
