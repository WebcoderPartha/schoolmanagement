<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    public function AllStudentView(){

        return view('backend.students.all_student_view');
    }

    public function StudentRegistration(){

        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['classes'] = StudentClass::all();
        return view('backend.students.register_student', $data);
    }
}
