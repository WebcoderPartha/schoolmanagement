@extends('layout.admin_master')
@section('title')
    Registration Fee Details
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="card-title">Registration Fee Details
                        </h2>
                        <h3>{{$regiYears[0]->year->student_year}}</h3>

                    </div>
                    <div class="card-body">
                        <a href="{{ route('regi.fees.add') }}" class="float-right btn btn-sm btn-primary"><i class="typcn typcn-plus btn-icon-append"></i> Add Registration Fee</a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Registration Fee</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($regiYears) > 0)

                                    @foreach($regiYears as $key => $year)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $year->class->class_name }}</td>
                                            <td>{{ $year->fee_amount }}</td>

                                            <td>

                                                <a href="{{ route('regiDelbyYearClassId', ['student_year_id' =>$year->year->id, 'student_class_id' => $year->class->id]) }}" id="delete" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    Delete
                                                    <i class="typcn typcn-delete btn-icon-append"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No registration fee detail found.</h4></td>
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


