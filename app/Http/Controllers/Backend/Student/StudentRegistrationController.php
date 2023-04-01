<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Discount;
use App\Models\FeeCategory;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.students.all_student_view', $data);
    }

    public function stentClassYearWise(Request $request){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
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

            // Register Student
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
            $student->address = $request->address;
            $student->image = $directory.$imageName;
            $student->save();

            // Assign Student
            $assignStudent = new AssignStudent();
            $assignStudent->student_id = $student->id; // Register Id
            $assignStudent->class_id = $request->class_id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            // Discount
            $discount = new Discount();
            $discount->fee_category_id = $request->fee_category_id;
            $discount->student_id = $student->id; // Register Id
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
            $student->address = $request->address;
            $student->save();

            // Assign Student
            $assignStudent = new AssignStudent();
            $assignStudent->student_id = $student->id; // Register Id
            $assignStudent->class_id = $request->class_id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discount = new Discount();
            $discount->fee_category_id = $request->fee_category_id;
            $discount->student_id = $student->id; // Register Id
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
        $data['student'] = Student::find($id);
        $data['discount'] = Discount::where('student_id', $id)->first();
        $data['assignStudent'] = AssignStudent::where('student_id', $id)->first();
        return view('backend.students.register_student_edit', $data);

    }

    public function StudentRegistrationUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dateofbirth' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'class_id' => 'required',
            'year_id' => 'required',
            'shift_id' => 'required',
            'group_id' => 'required'
        ]);


        $student = Student::find($id);

        if ($request->file('image')){

            $image = $request->file('image');
            $imageName = 'student-'.$student->id_number.'.'.$image->getClientOriginalExtension();
            $directory = 'uploads/student/';
            Image::make($image)->resize(300, 300)->save($directory.$imageName);


            if ($student->image !== NULL){
                if (file_exists(public_path($student->image))){
                    unlink(public_path($student->image));
                }
            }

            $student->name = $request->name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->dateofbirth = $request->dateofbirth;
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->image = $directory.$imageName;
            $student->save();

            // Assign Student
            $assignStudent = AssignStudent::where('student_id', $id)->first();
            $assignStudent->student_id = $student->id; // Register Id
            $assignStudent->class_id = $request->class_id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discount = Discount::where('student_id', $id)->first();
            $discount->fee_category_id = $request->fee_category_id;
            $discount->student_id = $student->id;
            $discount->discount = $request->discount;
            $discount->save();

            Toastr::success('Student update successfully');
            return Redirect::route('student.all.view');

        }else{

            $student->name = $request->name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->dateofbirth = $request->dateofbirth;
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->save();

            // Assign Student
            $assignStudent = AssignStudent::where('student_id', $id)->first();
            $assignStudent->student_id = $student->id; // Register Id
            $assignStudent->class_id = $request->class_id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discount = Discount::where('student_id', $id)->first();
            $discount->fee_category_id = $request->fee_category_id;
            $discount->student_id = $student->id;
            $discount->discount = $request->discount;
            $discount->save();

            Toastr::success('Student updated successfully');
            return Redirect::route('student.all.view');
        }

    }

    public function StudentDetailGetByID($id){
        $student = AssignStudent::where('student_id', $id)->first();
        return view('backend.students.student_get_by_id', compact('student'));
    }

    public function downloadStudentPDF($id){
        $data['student'] = AssignStudent::where('student_id', $id)->first();
        $data['path']  =$data['student']->student->image;
        $studentId  =$data['student']->student->id_number;

        $data['image'] = base64_encode(file_get_contents(public_path($data['path'])));

        $pdf = Pdf::loadView('backend.pdf.student_get_by_id', $data);
        return $pdf->download($studentId.'.pdf');
    }
    public function PDFStudentDetailGetByID($id){
        $data['student'] = AssignStudent::where('student_id', $id)->first();
        $data['path']  =$data['student']->student->image;
        $studentId  =$data['student']->id_number;
//        return view('backend.pdf.student_get_by_id', compact('student'));

        $data['image'] = base64_encode(file_get_contents(public_path($data['path'])));

        $pdf = Pdf::loadView('backend.pdf.student_get_by_id', $data);
        return $pdf->stream($studentId.'.pdf');
    }

    public function regiStudentDestroy($year_id, $class_id, $student_id){

        $student = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $student_id)->first();
        $student->delete();
        Toastr::success('Student deleted successfully');
            return Redirect::route('student.all.view');
//        $assignStudent = AssignStudent::where('student_id', $id)->first();
//        $discount = Discount::where('student_id', $id)->first();

//        if($student->image !== NULL){
//
//            if (file_exists(public_path($student->image))){
//                unlink(public_path($student->image));
//
//                $student->delete();
//                $assignStudent->delete();
//                $discount->delete();
//
//                Toastr::success('Student deleted successfully');
//                return Redirect::route('student.all.view');
//
//            }else{
//
//                $student->delete();
//                $assignStudent->delete();
//                $discount->delete();
//                Toastr::success('Student deleted successfully');
//                return Redirect::route('student.all.view');
//            }
//        }else{
//
//            $student->delete();
//            $assignStudent->delete();
//            $discount->delete();
//
//            Toastr::success('Student deleted successfully');
//            return Redirect::route('student.all.view');
//        }

    }

    public function studentPromotionView($student_id){

        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();
        $data['student'] = Student::find($student_id);
        $data['discount'] = Discount::where('student_id', $student_id)->first();
        $data['assignStudent'] = AssignStudent::where('student_id', $student_id)->first();
        return view('backend.students.promote_student', $data);

    }

    public function studentPromotionUpdate(Request $request, $student_id){

        $this->validate($request, [
            'class_id' => 'required',
            'year_id' => 'required',
            'shift_id' => 'required',
            'group_id' => 'required'
        ]);

        $student = Student::find($student_id);

        $assignStudent = new AssignStudent();
        $assignStudent->student_id = $student->id;
        $assignStudent->class_id = $request->class_id;
        $assignStudent->year_id = $request->year_id;
        $assignStudent->shift_id = $request->shift_id;
        $assignStudent->group_id = $request->group_id;
        $assignStudent->save();

        $discount = Discount::where('student_id', $student_id)->first();
        $discount->fee_category_id = $request->fee_category_id;
        $discount->discount = $request->discount;
        $discount->save();

        Toastr::success('Student promotion successfully');
        return Redirect::route('student.all.view');

    }

}
