<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MarkController extends Controller
{

    public function MarkView(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.manage_mark.mark_view', $data);

    }

    public function ClassSubjectGet(Request $request){

        $data['subjects'] = AssignSubject::with('subject')->where('class_id', $request->class_id)->get();
        return Response::json($data);
    }


}
