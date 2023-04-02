@extends('layout.admin_master')
@section('title')
    Registration Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Registration Fee <a href="{{ route('regi.fees.add') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-plus btn-icon-append"></i> Add Registration Fee</a></h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Registration Year</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($years) > 0)

                                    @foreach($years as $key => $year)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $year->year->student_year }}</td>

                                            <td>

                                                <a href="{{ route('regi.fees.edit', ['student_year_id'=>$year->student_year_id]) }}" type="button" class="btn btn-success btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('regi.fees.details',['student_year_id'=>$year->student_year_id]) }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    Details
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>

                                                <a href="{{ route('RegYearwisePDF', ['student_year_id'=> $year->student_year_id]) }}" class="btn btn-sm btn-primary btn-icon-text">
                                                    Print
                                                    <i class="typcn typcn-printer btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No registration year found.</h4></td>
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

