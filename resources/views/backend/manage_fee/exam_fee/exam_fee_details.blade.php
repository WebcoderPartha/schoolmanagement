@extends('layout.admin_master')
@section('title')
    Exam Fee Details
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="card-title">Exam Fee Details
                        </h2>
                        <h3>{{$examFees[0]->exam->name}} | {{$examFees[0]->year->student_year}}</h3>

                    </div>
                    <div class="card-body">
                        <a href="{{ route('exam.fees.view') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-arrow-left btn-icon-append"></i> Back</a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Exam Fee</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($examFees) > 0)

                                    @foreach($examFees as $key => $examFee)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $examFee->class->class_name }}</td>
                                            <td>{{ $examFee->fee_amount }}</td>

                                            <td>

                                                <a href="{{ route('examFeeDel', ['year_id' =>$examFee->year->id, 'exam_type_id' => $examFee->exam->id, 'class_id' =>$examFee->class->id]) }}" id="delete" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    Delete
                                                    <i class="typcn typcn-delete btn-icon-append"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No monthly fee detail found.</h4></td>
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


