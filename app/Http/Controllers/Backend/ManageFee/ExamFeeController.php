<?php

namespace App\Http\Controllers\Backend\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\ExamFee;
use Illuminate\Http\Request;

class ExamFeeController extends Controller
{

    public function ExamFeeView(){

        $data['years'] = ExamFee::with('class', 'year', 'exam')->select(['year_id', 'exam_type_id'])->groupBY(['year_id', 'exam_type_id'])->get();
        return view('backend.manage_fee.monthly_fee.monthly_fee_view', $data);

    }

}
