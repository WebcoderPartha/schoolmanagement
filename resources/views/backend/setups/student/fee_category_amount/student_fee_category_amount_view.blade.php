@extends('layout.admin_master')
@section('title')
    Fee Category Amount
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Fee Amount <a href="{{ route('student.fcamount.add') }}" class="float-right btn btn-sm btn-primary">Add Fee <i class="typcn typcn-plus btn-icon-append"></i></a></h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Class</th>
                                    <th>Fee Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($feecatamounts))
                                    @foreach($feecatamounts as $key => $feecatamount)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $feecatamount->fee_category->name }}</td>
                                            <td>{{ $feecatamount->student_class->class_name  }}</td>
                                            <td>

                                                <a href="{{ route('student.fcamount.edit', $feecatamount->id) }}" type="button" class="btn btn-success btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a id="delete" href="{{ route('student.fcamount.delete', $feecatamount->id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    Delete
                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No student fee amount found.</h4></td>
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

