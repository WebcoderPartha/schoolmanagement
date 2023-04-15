<?php

namespace App\Http\Controllers\Backend\ManageReport;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Mark;
use App\Models\MarksGrade;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentMarkSheetController extends Controller
{

    public function MarksheetGenerateView(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExamType::all();

        return view('backend.manage_reports.marksheet_report.marksheet_genarate_view', $data);
    }

    public function SearchMarksheet(Request $request){

        $validate = $request->validate([
            'year_id' => 'required',
            'class_id' => 'required',
            'exam_type_id' => 'required',
            'id_number' => 'required'
        ]);

        // Check SID exist or not
        $checkID = Mark::where(['id_number' => $request->id_number])->first();

        $fail = Mark::where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id,
            'exam_type_id' => $request->exam_type_id,
            'id_number' => $request->id_number,
            ['marks', '<', 33]
        ])->get()->count();

        if ($checkID !== NULL){

            if ($fail === 0){

                $data['allGrades'] = MarksGrade::all();

                $data['allMarks'] = Mark::with('exam', 'year', 'class', 'student','assign_student', 'subject')->where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'exam_type_id' => $request->exam_type_id,
                    'id_number' => $request->id_number
                ])->get();


                // Total Subject
                $data['totalSubject']= Mark::where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'exam_type_id' => $request->exam_type_id,
                    'id_number' => $request->id_number
                ])->get()->count();

                // Total Mark
                $data['total_mark'] = Mark::where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'exam_type_id' => $request->exam_type_id,
                    'id_number' => $request->id_number
                ])->sum('marks');

                $data['average'] = (float)$data['total_mark'] / $data['totalSubject'];

                $data['cgpa'] = MarksGrade::where([
                    ['start_marks', '<=', $data['average']],
                    ['end_marks', '>=', $data['average']]
                ])->first();

                return view('backend.manage_reports.marksheet_report.marksheet_genarate', $data);



            }else{

                $data['allGrades'] = MarksGrade::all();

                $data['allMarks'] = Mark::with('exam', 'year', 'class', 'student','assign_student', 'subject')->where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'exam_type_id' => $request->exam_type_id,
                    'id_number' => $request->id_number
                ])->get();


                // Total Subject
                $data['totalSubject']= Mark::where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'exam_type_id' => $request->exam_type_id,
                    'id_number' => $request->id_number
                ])->get()->count();

                // Total Mark
                $data['total_mark'] = Mark::where([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'exam_type_id' => $request->exam_type_id,
                    'id_number' => $request->id_number
                ])->sum('marks');

                $data['average'] = $data['total_mark'] / $data['totalSubject'];

                $data['cgpa'] = MarksGrade::where([
                    ['start_marks', '<=', 30],
                    ['end_marks', '>=', 30]
                ])->first();


                return view('backend.manage_reports.marksheet_report.fail_marksheet_genarate', $data);


            }


        }else{

            Toastr::error('Student ID not exist!');
            return Redirect::back();
        }



    } // END METHOD

    public function DownloadMarksheetPDF($year_id, $class_id, $exam_type_id, $id_number){


        // Check SID exist or not
        $checkID = Mark::where(['id_number' => $id_number])->first();


        $data['allGrades'] = MarksGrade::all();

        $data['allMarks'] = Mark::with('exam', 'year', 'class', 'student','assign_student', 'subject')->where([
                    'year_id' => $year_id,
                    'class_id' => $class_id,
                    'exam_type_id' => $exam_type_id,
                    'id_number' => $id_number
        ])->get();


        // Total Subject
        $data['totalSubject']= Mark::where([
                    'year_id' => $year_id,
                    'class_id' => $class_id,
                    'exam_type_id' => $exam_type_id,
                    'id_number' => $id_number
        ])->get()->count();

                // Total Mark
        $data['total_mark'] = Mark::where([
            'year_id' => $year_id,
            'class_id' => $class_id,
            'exam_type_id' => $exam_type_id,
            'id_number' => $id_number
        ])->sum('marks');

        $data['average'] = (float)$data['total_mark'] / $data['totalSubject'];

        $data['cgpa'] = MarksGrade::where([
            ['start_marks', '<=', (float)$data['average']],
            ['end_marks', '>=', (float)$data['average']]
        ])->first();


//        return view('backend.pdf.marksheet_download', $data);
        $pdf = Pdf::loadView('backend.pdf.marksheet_download', $data);
        return $pdf->stream('result-marksheet.pdf');

    }


    public function DownloadFailMarksheetPDF($year_id, $class_id, $exam_type_id, $id_number){


        // Check SID exist or not
        $checkID = Mark::where(['id_number' => $id_number])->first();


        $data['allGrades'] = MarksGrade::all();

        $data['allMarks'] = Mark::with('exam', 'year', 'class', 'student','assign_student', 'subject')->where([
            'year_id' => $year_id,
            'class_id' => $class_id,
            'exam_type_id' => $exam_type_id,
            'id_number' => $id_number
        ])->get();


        // Total Subject
        $data['totalSubject']= Mark::where([
            'year_id' => $year_id,
            'class_id' => $class_id,
            'exam_type_id' => $exam_type_id,
            'id_number' => $id_number
        ])->get()->count();

        // Total Mark
        $data['total_mark'] = Mark::where([
            'year_id' => $year_id,
            'class_id' => $class_id,
            'exam_type_id' => $exam_type_id,
            'id_number' => $id_number
        ])->sum('marks');

        $data['average'] = (float)$data['total_mark'] / $data['totalSubject'];

        $data['cgpa'] = MarksGrade::where([
            ['start_marks', '<=', (float)$data['average']],
            ['end_marks', '>=', (float)$data['average']]
        ])->first();


//        return view('backend.pdf.marksheet_download', $data);
        $pdf = Pdf::loadView('backend.pdf.fail_marksheet_download', $data);
        return $pdf->stream('result-marksheet.pdf');

    }


}
