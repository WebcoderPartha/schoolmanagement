<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentGroupController extends Controller
{
    public function StudentGroupView(){
        $studentGroups = StudentGroup::all();
        return view('backend.setups.student.group.student_group_view', compact('studentGroups'));
    }

//    public function StudentClassAdd(){
//        return view('backend/setups/student/student_class_add');
//    }

    public function StudentGroupStore(Request $request){
        $this->validate($request, [
            'student_group' => 'required|unique:student_groups,student_group'
        ]);

        $studentGroup = new StudentGroup();
        $studentGroup->student_group = $request->student_group;
        $studentGroup->save();

        Toastr::success('Student group added successfully!');
        return Redirect::route('student.group.view');

    }

    public function StudentGroupEdit($id)
    {

        $studentGroup = StudentGroup::find($id);
        return view('backend.setups.student.group.student_group_edit', compact('studentGroup'));

    }

    public function StudentGroupUpdate(Request $request, $id){

        $studentGroup = StudentGroup::find($id);
        $this->validate($request, [
            'student_group' => 'required|unique:student_groups,student_group,'.$studentGroup->id
        ]);

        $studentGroup->student_group = $request->student_group;
        $studentGroup->save();

        Toastr::success('Student group updated successfully!');
        return Redirect::route('student.group.view');

    }

    public function StudentGroupDestroy($id){

        $studentGroup = StudentGroup::find($id);
        $studentGroup->delete();
        Toastr::success('Student group deleted successfully!');
        return Redirect::route('student.group.view');

    }
}
