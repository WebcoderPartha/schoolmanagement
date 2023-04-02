<?php

namespace App\Http\Controllers\Backend\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\MonthlyFee;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MonthlyFeeController extends Controller
{
    public function MonthlyFeeView(){

        $data['years'] = MonthlyFee::with('class', 'year')->select(['student_year_id', 'month_id'])->groupBY(['student_year_id', 'month_id'])->get();
        return view('backend.manage_fee.monthly_fee.monthly_fee_view', $data);

    }

    public function monthlyFeeAdd(){
        $data['years']      = StudentYear::all();
        $data['classes']    = StudentClass::all();
        $data['months']     = Month::all();
        return view('backend.manage_fee.monthly_fee.monthly_fee_add', $data);
    }

    public function monthlyFeeStore(Request $request){
        $this->validate($request,[
            'student_year_id' => 'required',
            'student_class_id' => 'required',
            'student_class_id.*' => 'required',
            'fee_amount.*' => 'required',
            'fee_amount' => 'required',
            'month_id.*' => 'required',
            'month_id' => 'required',
        ]);


        $student_class_id = $request->student_class_id;
        $uniqueClass = count(array_unique($student_class_id));
        $count = count($student_class_id);

        if ($uniqueClass < $count){

            Toastr::warning('Same class cannot be added!');
            return Redirect::back();

        }else{

            for($i = 0; $i < $count; $i++){

                $monthlyFee = new MonthlyFee();
                $monthlyFee->student_year_id = $request->student_year_id;
                $monthlyFee->student_class_id = $request->student_class_id[$i];
                $monthlyFee->fee_amount = $request->fee_amount[$i];
                $monthlyFee->month_id = $request->month_id[$i];
                $monthlyFee->save();

            }

        }

        Toastr::success('Monthly Fee added successfully');
        return Redirect::route('monthly.fees.view');
    }

    public function monthlyFeeEdit($student_year_id, $month_id){
        $data['monthlyFees'] = MonthlyFee::where(['student_year_id' =>$student_year_id, 'month_id' => $month_id])->get();
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['months'] = Month::all();

        return view('backend.manage_fee.monthly_fee.monthly_fee_edit', $data);
    }

    public function monthlyFeeUpdate(Request $request, $student_year_id, $month_id){
        $this->validate($request,[
            'student_year_id' => 'required',
            'student_class_id' => 'required',
            'student_class_id.*' => 'required',
            'fee_amount.*' => 'required',
            'fee_amount' => 'required',
            'month_id.*' => 'required',
            'month_id' => 'required',
        ]);


        $student_class_id = $request->student_class_id;
        $uniqueClass = count(array_unique($student_class_id));
        $count = count($student_class_id);

        if ($uniqueClass < $count){

            Toastr::warning('Same class cannot be added!');
            return Redirect::back();

        }else{
            $oldMonthlyFee = MonthlyFee::where(['student_year_id' =>$student_year_id, 'month_id' => $month_id])->delete();
            for($i = 0; $i < $count; $i++){

                $monthlyFee = new MonthlyFee();
                $monthlyFee->student_year_id = $request->student_year_id;
                $monthlyFee->student_class_id = $request->student_class_id[$i];
                $monthlyFee->fee_amount = $request->fee_amount[$i];
                $monthlyFee->month_id = $request->month_id[$i];
                $monthlyFee->save();

            }

        }

        Toastr::success('Monthly fee updated successfully');
        return Redirect::route('monthly.fees.view');
    }

    public function monthlyFeeDetails($student_year_id, $month_id){
        $data['monthlyFees'] = MonthlyFee::with(['class', 'year', 'month'])->where(['student_year_id' =>$student_year_id, 'month_id' => $month_id])->get();
        return view('backend.manage_fee.monthly_fee.monthly_fee_details', $data);
    }

    public function monthlyFeeDelete($student_year_id, $month_id, $student_class_id){

        $delete =  MonthlyFee::where(['student_year_id' =>$student_year_id, 'month_id' => $month_id, 'student_class_id' => $student_class_id])->delete();

        Toastr::success('Monthly fee deleted successfully');
        return Redirect::back();
    }

    public function monthlyFeesWisePDF($student_year_id, $month_id){
        $data['allData'] = MonthlyFee::with(['class', 'year', 'month'])->where(['student_year_id' =>$student_year_id, 'month_id' => $month_id])->get();
        $PDF = Pdf::loadView('backend.pdf.monthly_fee_year_month_wise', $data);
        return $PDF->stream($data['allData'][0]->month->name.'-'.$data['allData'][0]->year->student_year.'.php');
    }


}
