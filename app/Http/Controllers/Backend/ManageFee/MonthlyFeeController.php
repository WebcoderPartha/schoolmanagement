<?php

namespace App\Http\Controllers\Backend\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\MonthlyFee;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MonthlyFeeController extends Controller
{
    public function MonthlyFeeView(){

        $data['years'] = MonthlyFee::with('class', 'year')->select('student_year_id')->groupBY('student_year_id')->get();
        return view('backend.manage_fee.monthly_fee.monthly_fee_view', $data);

    }

    public function monthlyFeeAdd(){
        $data['years']      = StudentYear::all();
        $data['classes']    = StudentClass::all();
        $data['months']     = Month::all();
        return view('backend.manage_fee.monthly_fee.monthly_fee_add', $data);
    }

}
