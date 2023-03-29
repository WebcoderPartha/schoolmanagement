@extends('layout.admin_master')
@section('title')
    Fee Amount Details
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fee Amount Details<a href="{{ route('student.fcamount.pdf',$amountAll[0]->fee_category_id ) }}" class="float-right btn btn-sm btn-primary">Print<i class="typcn typcn-printer btn-icon-append"></i></a></h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name {{$amountAll[0]->fee_category_id}}</th>
                                    <th>Class</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($amountAll))

                                    @foreach($amountAll as $key => $amount)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $amount->fee_category->name }}</td>
                                            <td>{{ $amount->student_class->class_name }}</td>
                                            <td>{{ $amount->amount }}</td>

                                            <td>

                                                <a id="delete" href="{{ route('student.fcamount.single.del', $amount->id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
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

