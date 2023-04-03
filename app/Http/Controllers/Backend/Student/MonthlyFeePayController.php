<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Month;
use App\Models\MonthlyFee;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MonthlyFeePayController extends Controller
{
    public function MonthlyFeeSearchView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['months'] = Month::all();

        return view('backend.pay_monthly_fee.pay_monthly_fee_view', $data);
    }

    public function payMonthlyFeeSearch(Request $request){

        $data['class_id'] = $request->class_id;
        $data['year_id'] = $request->year_id;
        $data['month_id'] = $request->month_id;
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['months'] = Month::all();

        $data['student_year'] = StudentYear::where('id',  $data['year_id'])->first();
        $data['student_class'] = StudentClass::where('id',  $data['class_id'])->first();
        $data['monthsss'] = Month::where('id',  $data['month_id'])->first();

        $data['monthlyFee'] = MonthlyFee::where([
            'student_class_id' => $data['class_id'],
            'student_year_id' => $data['year_id'],
            'month_id' => $data['month_id']
        ])->first();

        $data['students'] = AssignStudent::with('student','year')->where('class_id',$data['class_id'])->where('year_id', $data['year_id'])->get();

       return view('backend.pay_monthly_fee.pay_monthly_fee_search', $data);

    }

    public function payMonthlyFeePDF($year_id, $month_id, $class_id, $student_id){


         $data['monthlyFee'] = MonthlyFee::where(['student_class_id' => $class_id, 'student_year_id' =>
            $year_id, 'month_id' => $month_id])->first();

         $data['student'] = AssignStudent::with('student','year', 'class')->where([
            'student_id' => $student_id,
            'year_id' => $year_id,
            'class_id' => $class_id
        ])->first();

         $PDF = Pdf::loadView('backend.pdf.student_monthly_feee_payslip', $data);
         return $PDF->stream($data['student']->student->id_number.'-'.$data['monthlyFee']->month->name.'.pdf');
    }


}
