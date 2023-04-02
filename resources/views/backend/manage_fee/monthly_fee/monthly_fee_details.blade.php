@extends('layout.admin_master')
@section('title')
    Monthly Fee Details
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="card-title">Monthly Fee Details
                        </h2>
                        <h3>{{$monthlyFees[0]->month->name}} | {{$monthlyFees[0]->year->student_year}}</h3>

                    </div>
                    <div class="card-body">
                        <a href="{{ route('monthly.fees.view') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-arrow-left btn-icon-append"></i> Back</a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Monthly Fee</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($monthlyFees) > 0)

                                    @foreach($monthlyFees as $key => $monthFee)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $monthFee->class->class_name }}</td>
                                            <td>{{ $monthFee->fee_amount }}</td>

                                            <td>

                                                <a href="{{ route('monthlyFeeDel', ['student_year_id' =>$monthFee->year->id, 'month_id' => $monthFee->month->id, 'student_class_id' =>$monthFee->class->id]) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
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


