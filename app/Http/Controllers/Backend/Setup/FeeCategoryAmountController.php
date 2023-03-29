<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeCategoryAmountController extends Controller
{

    public function StudentFeeCategoryAmountView(){
        $feecatamounts = FeeCategoryAmount::all();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_view', compact('feecatamounts'));

    }

    public function StudentFeeCategoryAmountCreate(){
        $feeCats = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_add', compact('feeCats', 'classes'));
    }
    public function StudentFeeCategoryAmountStore(Request $request){

    }

    public function StudentFeeCategoryAmountEdit($id){
        $feeCat = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_edit', compact('feeCat', 'classes'));
    }

    public function StudentFeeCategoryAmountUpdate(Request $request, $id){

    }

    public function StudentFeeCategoryAmountDestroy($id){

    }

}
