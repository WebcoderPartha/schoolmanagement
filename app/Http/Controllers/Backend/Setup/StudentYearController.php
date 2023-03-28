<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentYearController extends Controller
{

    public function StudentYearView(){
        $studentYears = StudentYear::all();
        return view('backend.setups.student.year.student_year_view', compact('studentYears'));
    }

//    public function StudentClassAdd(){
//        return view('backend/setups/student/student_class_add');
//    }

    public function StudentYearStore(Request $request){
        $this->validate($request, [
            'student_year' => 'required|unique:student_years,student_year'
        ]);

        $studentYear = new StudentYear();
        $studentYear->student_year = $request->student_year;
        $studentYear->save();

        Toastr::success('Student year added successfully!');
        return Redirect::route('student.year.view');

    }

    public function StudentYearEdit($id)
    {

        $studentYear = StudentYear::find($id);
        return view('backend.setups.student.year.student_year_edit', compact('studentYear'));

    }

    public function StudentYearUpdate(Request $request, $id){

        $studentYear = StudentYear::find($id);
        $this->validate($request, [
            'student_year' => 'required|unique:student_years,student_year,'.$studentYear->id
        ]);

        $studentYear->student_year = $request->student_year;
        $studentYear->save();

        Toastr::success('Student year updated successfully!');
        return Redirect::route('student.year.view');

    }

    public function StudentYearDestroy($id){

        $studentYear = StudentYear::find($id);
        $studentYear->delete();
        Toastr::success('Student year deleted successfully!');
        return Redirect::route('student.year.view');

    }


}
