<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\FeeCategory;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class StudentRegistrationController extends Controller
{
    public function AllStudentView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = StudentYear::orderBy('id', 'asc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'asc')->first()->id;
        $data['allData'] = Student::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.students.all_student_view', $data);
    }

    public function stentClassYearWise(Request $request){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['allData'] = Student::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.students.all_student_view', $data);
    }
    public function StudentRegistration(){

        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();
        return view('backend.students.register_student', $data);
    }

    public function registrationStore(Request $request){
//        $this->validate($request, [
//            'name' => 'required',
//            'father_name' => 'required',
//            'mother_name' => 'required',
//            'dateofbirth' => 'required',
//            'religion' => 'required',
//            'gender' => 'required',
//            'phone' => 'required',
//            'address' => 'required',
//            'class_id' => 'required',
//            'year_id' => 'required',
//            'shift_id' => 'required',
//            'group_id' => 'required'
//        ]);

        $id_number = IdGenerator::generate([
            'table' => 'students',
            'field' => 'id_number',
            'length' => 8,
            'prefix' => date('Y')
        ]);

        if ($request->file('image')){

            $image = $request->file('image');
            $imageName = 'student-'.$id_number.'.'.$image->getClientOriginalExtension();
            $directory = 'uploads/student/';
            Image::make($image)->resize(300, 300)->save($directory.$imageName);
            $student = new Student();
            $student->name = $request->name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->dateofbirth = $request->dateofbirth;
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->id_number = $id_number;
            $student->class_id = $request->class_id;
            $student->year_id = $request->year_id;
            $student->address = $request->address;
            $student->shift_id = $request->shift_id;
            $student->group_id = $request->group_id;
            $student->image = $directory.$imageName;
            $student->save();

            $discount = new Discount();
            $discount->fee_category_id = $request->fee_category_id;
            $discount->student_id = $student->id;
            $discount->discount = $request->discount;
            $discount->save();

            Toastr::success('Student registration successfully');
            return Redirect::route('student.all.view');

        }else{

            $student = new Student();
            $student->name = $request->name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->dateofbirth = $request->dateofbirth;
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->id_number = $id_number;
            $student->class_id = $request->class_id;
            $student->year_id = $request->year_id;
            $student->address = $request->address;
            $student->shift_id = $request->shift_id;
            $student->group_id = $request->group_id;
            $student->save();


            $discount = new Discount();
            $discount->fee_category_id = $request->fee_category_id;
            $discount->student_id = $student->id;
            $discount->discount = $request->discount;
            $discount->save();

            Toastr::success('Student registration successfully');
            return Redirect::route('student.all.view');
        }

    }

    public function StudentRegistrationEdit($id){

        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();
        return view('backend.students.register_student', $data);

    }

}
