<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeeCategoryController extends Controller
{
    public function StudentFeeCategoryView(){

        $feeCategories = FeeCategory::all();
        return view('backend.setups.student.fee_category.student_fee_category_view', compact('feeCategories'));

    }


    public function StudentFeeCategoryStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:fee_categories,name'
        ]);

        $feeCat = new FeeCategory();
        $feeCat->name = $request->name;
        $feeCat->save();

        Toastr::success('Fee category added successfully!');
        return Redirect::route('student.fcategory.view');

    }

    public function StudentFeeCategoryEdit($id)
    {

        $feecat = FeeCategory::find($id);
        return view('backend.setups.student.fee_category.student_fee_category_edit', compact('feecat'));

    }

    public function StudentFeeCategoryUpdate(Request $request, $id){

        $feecat = FeeCategory::find($id);
        $this->validate($request, [
            'name' => 'required|unique:fee_categories,name,'.$feecat->id
        ]);

        $feecat->name = $request->name;
        $feecat->save();

        Toastr::success('Fee category updated successfully!');
        return Redirect::route('student.fcategory.view');

    }

    public function StudentFeeCategoryDestroy($id){

        $fee_cat = FeeCategory::find($id);
        $fee_cat->delete();
        Toastr::success('Fee category deleted successfully!');
        return Redirect::route('student.fcategory.view');

    }


}
