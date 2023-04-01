<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class RollController extends Controller
{

    public function RoleGenerateView(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.roll.role_generate_view', $data);
    }

    public function stentClassYearWise(Request $request){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.roll.role_generate_view', $data);
    }

    public function RoleGenerateSearch(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;


        if ($year_id !== NULL & $class_id !== NULL){
            $data = AssignStudent::with('year', 'student', 'class')->where('year_id', $year_id)->where('class_id', $class_id)->get();
            return Response::json($data);
        }else{
            echo 'not working';
        }

    }

    public function RoleGenerateStore(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->year_id !== null && $request->class_id !== null){
            $countStudent = count($request->student_id);
            for ($i = 0; $i < $countStudent; $i++){
                if ($request->roll_number[$i] !== 'null' && !empty($request->roll_number[$i])){
                  $assignStudent = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $request->student_id[$i])->first();
                  $assignStudent->roll_number = $request->roll_number[$i];
                  $assignStudent->save();
                }else{
                    return 'errror';
                }
            }
        }

        return \response()->json(['success' => 'Roll generated successfully!']);


    }

}
