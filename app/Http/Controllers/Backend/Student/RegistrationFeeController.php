<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Backend\RegistrationFee;
use App\Models\Discount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegistrationFeeController extends Controller
{

    public function RegiFeeView(){
        $data['years'] = RegistrationFee::with('class', 'year')->select('student_year_id')->groupBY('student_year_id')->get();
        return view('backend.manage_fee.registration_fee_view', $data);
    }

    public function RegiFeeAdd(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.manage_fee.registration_fee_add', $data);
    }

    public function RegistrationFeeStore(Request $request){
        $this->validate($request,[
            'student_year_id' => 'required',
            'student_class_id' => 'required',
            'student_class_id.*' => 'required',
            'fee_amount.*' => 'required',
            'fee_amount' => 'required'
        ]);

        $student_class_id = $request->student_class_id;
        $unique = count(array_unique($student_class_id));
        $count = count($student_class_id);

        if ($unique < $count){

            Toastr::warning('Same class cannot be added!');
            return Redirect::back();

        }else{

            for($i = 0; $i < $count; $i++){

                $registration = new RegistrationFee();
                $registration->student_year_id = $request->student_year_id;
                $registration->student_class_id = $request->student_class_id[$i];
                $registration->fee_amount = $request->fee_amount[$i];
                $registration->save();

            }

        }

        Toastr::success('Registration Fee added successfully');
        return Redirect::route('regi.fees.view');


    }


    public function RegistrationFeeEdit($student_year_id){
        $data['regiYears'] = RegistrationFee::where('student_year_id', $student_year_id)->get();
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.manage_fee.registration_fee_edit', $data);

    }

    public function RegistrationFeeUpdate(Request $request,$student_year_id){

        $this->validate($request,[
            'student_year_id' => 'required',
            'student_class_id' => 'required',
            'student_class_id.*' => 'required',
            'fee_amount.*' => 'required',
            'fee_amount' => 'required'
        ]);

        $student_class_id = $request->student_class_id;
        $unique = count(array_unique($student_class_id));
        $count = count($student_class_id);

        if ($unique < $count){

            Toastr::warning('Same class cannot be added!');
            return Redirect::back();

        }else{
            $regiOld = RegistrationFee::where('student_year_id', $student_year_id)->delete();

            for($i = 0; $i < $count; $i++){

                $registration = new RegistrationFee();
                $registration->student_year_id = $request->student_year_id;
                $registration->student_class_id = $request->student_class_id[$i];
                $registration->fee_amount = $request->fee_amount[$i];
                $registration->save();

            }

        }

        Toastr::success('Registration Fee updated successfully');
        return Redirect::route('regi.fees.view');

    }

    public function RegistrationFeeDetails($student_year_id){
        $data['regiYears'] = RegistrationFee::with('year', 'class')->where('student_year_id', $student_year_id)->get();

        return view('backend.manage_fee.registration_fee_details', $data);
    }

    public function regiDelByYearClassId($student_year_id, $student_class_id){
        $regiFee = RegistrationFee::where('student_year_id', $student_year_id)->where('student_class_id', $student_class_id)->first();
        $regiFee->delete();
        Toastr::success('Deleted successfully');
        return Redirect::back();

    }

    public function RegistrationFeeYearWisePDF($student_year_id){
        $data['allData'] = RegistrationFee::with('year', 'class')->where('student_year_id', $student_year_id)->get();

        $pdf = Pdf::loadView('backend.pdf.registration_fee_year_wise', $data);
        return $pdf->stream('registration-fee-'.$data['allData'][0]->year->student_year.'.pdf');
    }
//    public function RegistrationFeeSearchView(){
//
//        $data['years'] = StudentYear::all();
//        $data['classes'] = StudentClass::all();
//
//        return view('backend.registration_fee.regisration_fee_view', $data);
//
//    }
//
//    public function RegistrationFeeGetting(Request $request){
//        $class_id = $request->class_id;
//        $year_id = $request->year_id;
//        $data['years'] = StudentYear::all();
//        $data['classes'] = StudentClass::all();
//
//        if ($class_id !== null && !empty($class_id) && $year_id !== null && !empty($year_id)){
//            $data['students'] = AssignStudent::with('student', 'year', 'class', 'discount')->where('class_id', $class_id)->where('year_id', $year_id)->get();
//            if (count($data['students']) > 0){
//                return view('backend.registration_fee.regisration_fee_search', $data);
//            }else{
//                Toastr::warning('Search Result Not Found');
//                return Redirect::back();
//            }
//
//        }else{
//            Toastr::warning('Select Year & Class!');
//            return Redirect::back();
//        }
//    }
//
//    public function PaySlipPDF($year, $class, $student_id){
//        $data['student'] = AssignStudent::with('class', 'year','student', 'discount')->where('year_id', $year)->where('class_id', $class)->where('student_id', $student_id)->first();
//        $student_id = $data['student']->student->id_number;
//
//        $PDF = Pdf::loadView('backend.pdf.student_regi_payslip', $data);
//        return $PDF->stream('payslip-'.$student_id.'.pdf');
//    }


}
