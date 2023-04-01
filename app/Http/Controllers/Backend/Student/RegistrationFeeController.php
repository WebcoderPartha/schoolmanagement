<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Discount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegistrationFeeController extends Controller
{
    public function RegistrationFeeSearchView(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.registration_fee.regisration_fee_view', $data);

    }

    public function RegistrationFeeGetting(Request $request){
        $class_id = $request->class_id;
        $year_id = $request->year_id;
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        if ($class_id !== null && !empty($class_id) && $year_id !== null && !empty($year_id)){
            $data['students'] = AssignStudent::with('student', 'year', 'class', 'discount')->where('class_id', $class_id)->where('year_id', $year_id)->get();
            if (count($data['students']) > 0){
                return view('backend.registration_fee.regisration_fee_search', $data);
            }else{
                Toastr::warning('Search Result Not Found');
                return Redirect::back();
            }

        }else{
            Toastr::warning('Select Year & Class!');
            return Redirect::back();
        }
    }

    public function PaySlipPDF($year, $class, $student_id){
        $data['student'] = AssignStudent::with('class', 'year','student', 'discount')->where('year_id', $year)->where('class_id', $class)->where('student_id', $student_id)->first();
        $student_id = $data['student']->student->id_number;

        $PDF = Pdf::loadView('backend.pdf.student_regi_payslip', $data);
        return $PDF->stream('payslip-'.$student_id.'.pdf');
    }

}
