@extends('layout.admin_master')
@section('title')
    Account Student Fee
@endsection
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Fees <a href="{{ route('accounts.student_fee_add') }}" class="float-right btn btn-sm btn-primary">Add Student Fee<i class="typcn typcn-plus btn-icon-append"></i></a></h4>



                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Fee Name</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($studentFees) > 0)

                                    @foreach($studentFees as $key => $studentFee)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $studentFee->year->student_year }}</td>
                                            <td>{{ $studentFee->class->class_name }}</td>
                                            <td>{{ $studentFee->student->id_number }}</td>
                                            <td>{{ $studentFee->student->name }}</td>
                                            <td>{{ $studentFee->fee_amount }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">  <h4 class="text-center">No student fee found in account.</h4></td>
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

