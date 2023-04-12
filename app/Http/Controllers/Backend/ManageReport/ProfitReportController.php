<?php

namespace App\Http\Controllers\Backend\ManageReport;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProfitReportController extends Controller
{

    public function ProfitReportView(){

        return view('backend.manage_reports.profit_report.profit_view');

    }

    public function SearchProfitReport(Request $request){


        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $start_date = date('m-Y', strtotime($request->start_date));
        $end_date = date('m-Y', strtotime($request->end_date));


        $Estart_date = date('F, Y', strtotime($request->start_date));
        $Eend_date = date('F, Y', strtotime($request->end_date));

        $data['studentFee'] = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $data['otherCost'] = AccountOtherCost::where('date', 'LIKE', '%'.$start_date.'%')->sum('amount');
        $data['AccountSalary'] = AccountEmployeeSalary::whereBetween('date', [$Estart_date, $Eend_date])->sum('amount');

        $data['totalCost'] =  $data['otherCost'] +  $data['AccountSalary'];

        $data['profit'] =  $data['studentFee'] - $data['totalCost'];

        return view('backend.manage_reports.profit_report.profit_view', $data);


    }

    public function PDFProfitReport($start_date, $end_date){

        $sDate = date('m-Y', strtotime($start_date));
        $edate = date('m-Y', strtotime($end_date));


        $Estart_date = date('F, Y', strtotime($start_date));
        $Eend_date = date('F, Y', strtotime($end_date));

         $data['studentFee'] = AccountStudentFee::whereBetween('date', [$sDate, $edate])->sum('amount');
         $data['otherCost'] = AccountOtherCost::where('date', 'LIKE', '%'.$sDate.'%')->sum('amount');
        $data['AccountSalary'] = AccountEmployeeSalary::whereBetween('date', [$Estart_date, $Eend_date])->sum('amount');

        $data['totalCost'] =  $data['otherCost'] +  $data['AccountSalary'];

        $data['profit'] =  $data['studentFee'] - $data['totalCost'];
        $data['date'] = date('F, Y', strtotime($start_date));

        $pdf = Pdf::loadView('backend.pdf.profit_report_pdf', $data);
        return $pdf->stream($data['date'].'-profit-reports.pdf');
    }

}
