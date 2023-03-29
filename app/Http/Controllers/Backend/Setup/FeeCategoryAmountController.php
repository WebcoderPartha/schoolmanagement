<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeeCategoryAmountController extends Controller
{

    public function StudentFeeCategoryAmountView(){
        $feecatamounts = FeeCategoryAmount::with('fee_category', 'student_class')->select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_view', compact('feecatamounts'));

    }

    public function StudentFeeCategoryAmountCreate(){
        $feeCats = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_add', compact('feeCats', 'classes'));
    }
    public function StudentFeeCategoryAmountStore(Request $request){

        $this->validate($request, [
            'fee_category_id' => 'required',
            'student_class_id' => 'required',
            'student_class_id.*' => 'required',
            'amount' => 'required',
            'amount.*' => 'required'
        ]);

        $count_class = count($request->student_class_id);

        if ($count_class !== NULL){

            for ($i = 0 ; $i < $count_class; $i++){
                $FeeAmount = new FeeCategoryAmount();
                $FeeAmount->fee_category_id = $request->fee_category_id;
                $FeeAmount->student_class_id = $request->student_class_id[$i];
                $FeeAmount->amount = $request->amount[$i];
                $FeeAmount->save();
            }

        }

        Toastr::success('Category Fee Amount Added successfully!');
        return Redirect::route('student.fcamount.view');

    }

    public function StudentFeeCategoryAmountEdit($fee_category_id){
        $feeCats = FeeCategory::all();
        $classes = StudentClass::all();
        $amount = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->get();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_edit', compact('feeCats', 'classes', 'amount'));
    }

    public function StudentFeeCategoryAmountUpdate(Request $request, $fee_category_id){
        $this->validate($request, [
            'fee_category_id' => 'required'
        ]);

        if ($request->student_class_id !== NULL){

            $oldAmount = FeeCategoryAmount::where('fee_category_id', $fee_category_id);
            $oldAmount->delete();
            $classCount = count($request->student_class_id);
            for ($i = 0; $i < $classCount; $i++){
                $amount = new FeeCategoryAmount();
                $amount->fee_category_id = $request->fee_category_id;
                $amount->student_class_id = $request->student_class_id[$i];
                $amount->amount = $request->amount[$i];
                $amount->save();
            }


        }else{
            Toastr::error('Class must not be empty!');
            return Redirect::back();
        }

        Toastr::success('Fee Category updated successfully!');
        return Redirect::route('student.fcamount.view');

    }

    public function StudentFeeCategoryAmountDestroy($fee_category_id){

        $FeeAmount = FeeCategoryAmount::where('fee_category_id', $fee_category_id);
        $FeeAmount->delete();

        Toastr::success('Category Fee Amount deleted successfully!');
        return Redirect::route('student.fcamount.view');

    }

    public function FeeAmountDetails($fee_category_id){
        $amountAll = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('student_class_id', 'ASC')->get();
        return view('backend.setups.student.fee_category_amount.student_fee_category_amount_details', compact('amountAll'));
    }

    public function FeeAmountDetailsPDF($fee_category_id){

        $data['amounts'] = FeeCategoryAmount::with('fee_category', 'student_class')->where('fee_category_id', $fee_category_id)->orderBy('student_class_id', 'asc')->get();

        $pdf = Pdf::loadView('backend.pdf.category_fee_amount_pdf', $data);
        return $pdf->stream('fee_category_amount.pdf');

    }

    public function FeeAmountDeleteSingle($id){
        $delete = FeeCategoryAmount::find($id);
        $delete->delete();
        Toastr::success('Category Fee Amount deleted successfully!');
        return Redirect::back();
    }

}
