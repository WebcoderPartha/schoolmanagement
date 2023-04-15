<?php

namespace App\Http\Controllers\Backend\ManageReport;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Mark;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResultReportController extends Controller
{

    public function ResultReport(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();

        return view('backend.manage_reports.result_report.exam_result_report', $data);

    }

    public function GetResultReport(Request $request){

        $validate = $request->validate([
            'year_id' => 'required',
            'class_id' => 'required',
            'exam_type_id' => 'required'
        ]);

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $check = Mark::where([
            'year_id' => $year_id,
            'class_id' => $class_id,
            'exam_type_id' => $exam_type_id,
        ])->first();

        if ($check == true){


             $data['fails'] = \App\Models\Mark::where([
                'year_id' => $year_id,
                'class_id' => $class_id,
                'exam_type_id' => $exam_type_id

            ])->where('marks', '<', 33)->select('student_id', 'marks')->groupBy('student_id', 'marks')->get();

            $data['results'] =  Mark::with('student', 'class', 'year', 'exam','assign_student')->where([
                'year_id' => $year_id,
                'class_id' => $class_id,
                'exam_type_id' => $exam_type_id,
            ])->select('student_id', 'year_id', 'class_id', 'exam_type_id')->groupBy('student_id', 'year_id', 'class_id', 'exam_type_id')->get();

            return view('backend.manage_reports.result_report.exam_result_report_view', $data);


        }else{

            Toastr::warning('Result not found!');
            return Redirect::back();

        }

    }

}
