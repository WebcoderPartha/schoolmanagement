@extends('layout.admin_master')
@section('title')
    Monthly Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Monthly Fee <a href="{{ route('monthly.fees.add') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-plus btn-icon-append"></i> Add Monthly Fee</a></h4>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($years) > 0)

                                    @foreach($years as $key => $year)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $year->year->student_year }}</td>
                                            <td>{{ $year->month->name }}</td>

                                            <td>

                                                <a href="{{ route('monthly.fees.edit', ['student_year_id'=>$year->student_year_id, 'month_id' => $year->month_id]) }}" type="button" class="btn btn-success btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('monthly.fees.details',['student_year_id'=>$year->student_year_id, 'month_id' => $year->month_id]) }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    Details
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>

                                                <a href="{{ route('RegYearwisePDF', ['student_year_id'=> $year->student_year_id]) }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    Print
                                                    <i class="typcn typcn-printer btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No monthly fee found.</h4></td>
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

