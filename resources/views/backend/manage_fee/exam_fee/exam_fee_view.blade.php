@extends('layout.admin_master')
@section('title')
    Exam Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Exam Fee <a href="{{ route('exam.fees.add') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-plus btn-icon-append"></i> Add Exam Fee</a></h4>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Year</th>
                                    <th>Exam Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($exams) > 0)

                                    @foreach($exams as $key => $exam)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $exam->year->student_year }}</td>
                                            <td>{{ $exam->exam->name }}</td>

                                            <td>

                                                <a href="{{ route('exam.fees.edit', ['year_id'=>$exam->year_id, 'exam_type_id' => $exam->exam_type_id]) }}" type="button" class="btn btn-success btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('exam.fees.details',['year_id'=>$exam->year_id, 'exam_type_id' => $exam->exam_type_id]) }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    Details
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>

                                                <a href="{{ route('exam.fee.wise.pdf',['year_id'=>$exam->year_id, 'exam_type_id' => $exam->exam_type_id]) }}" class="btn btn-sm btn-primary btn-icon-text">
                                                    Print
                                                    <i class="typcn typcn-printer btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No exam fee found.</h4></td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

@endsection

