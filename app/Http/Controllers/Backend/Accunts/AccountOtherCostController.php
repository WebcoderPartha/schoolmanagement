<?php

namespace App\Http\Controllers\Backend\Accunts;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AccountOtherCostController extends Controller
{

    public function AccountOtherCostView(){
        $data['otherCosts'] = AccountOtherCost::orderBy('id', 'DESC')->get();
        return view('backend.accounts.other_cost.other_cost_view', $data);
    }


    public function AccountOtherCostStore(Request $request){
        $this->validate($request, [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $other = new AccountOtherCost();
        $other->amount = $request->amount;
        $other->description = $request->description;
        $other->date = date('d-m-Y', strtotime($request->date));
        $other->save();

        Toastr::success('Other cost added successfully!');
        return Redirect::back();

    }

    public function AccountOtherCostEdit($id){

        $otherCost = AccountOtherCost::find($id);
        return view('backend.accounts.other_cost.other_cost_edit', compact('otherCost'));

    }
    public function AccountOtherCostUpdate(Request $request, $id){
        $this->validate($request, [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $other = AccountOtherCost::find($id);
        $other->amount = $request->amount;
        $other->description = $request->description;
        $other->date = date('d-m-Y', strtotime($request->date));
        $other->save();
        Toastr::success('Other cost updated successfully!');
        return Redirect::route('accounts.other_cost_view');

    }

    public function AccountOtherCostDelete($id){

        $other = AccountOtherCost::find($id);
        $other->delete();

        Toastr::success('Other cost deleted successfully!');
        return Redirect::back();

    }

}
