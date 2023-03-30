<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DesignationController extends Controller
{
    public function designationView(){
        $allDesignation = Designation::all();

        return view('backend.setups.student.designation.designation_view', compact('allDesignation'));
    }

    public function designationStore(Request $request){

        $this->validate($request, [
            'name' => 'required|unique:designations,name'
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();
        Toastr::success('Designation added successfully');
        return Redirect::route('designation.view');

    }

    public function designationEdit($id){

        $designation = Designation::find($id);

        return view('backend.setups.student.designation.designation_edit', compact('designation'));

    }

    public function designationUpdate(Request $request, $id){
        $designation = Designation::find($id);
        $this->validate($request, [
            'name' => 'required|unique:designations,name,'.$designation->id
        ]);

        $designation->name = $request->name;
        $designation->save();
        Toastr::success('Designation updated successfully');
        return Redirect::route('designation.view');
    }

    public function designationDestroy($id){
        $designation = Designation::find($id);
        $designation->delete();
        Toastr::success('Designation deleted successfully');
        return Redirect::route('designation.view');
    }


}
