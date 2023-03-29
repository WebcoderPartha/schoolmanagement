<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentShiftController extends Controller
{
    public function StudentShiftView(){
        $studentShifts = StudentShift::all();
        return view('backend.setups.student.shift.student_shift_view', compact('studentShifts'));
    }

//    public function StudentClassAdd(){
//        return view('backend/setups/student/student_class_add');
//    }

    public function StudentShiftStore(Request $request){
        $this->validate($request, [
            'student_shift' => 'required|unique:student_shifts,student_shift'
        ]);

        $studentShift = new StudentShift();
        $studentShift->student_shift = $request->student_shift;
        $studentShift->save();

        Toastr::success('Student shift added successfully!');
        return Redirect::route('student.shift.view');

    }

    public function StudentShiftEdit($id)
    {

        $studentShift = StudentShift::find($id);
        return view('backend.setups.student.shift.student_shift_edit', compact('studentShift'));

    }

    public function StudentShiftUpdate(Request $request, $id){

        $studentShift = StudentShift::find($id);
        $this->validate($request, [
            'student_shift' => 'required|unique:student_shifts,student_shift,'.$studentShift->id
        ]);

        $studentShift->student_shift = $request->student_shift;
        $studentShift->save();

        Toastr::success('Student shift updated successfully!');
        return Redirect::route('student.shift.view');

    }

    public function StudentShiftDestroy($id){

        $studentShift = StudentShift::find($id);
        $studentShift->delete();
        Toastr::success('Student shift deleted successfully!');
        return Redirect::route('student.shift.view');

    }


}
