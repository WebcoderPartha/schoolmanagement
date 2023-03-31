@extends('layout.admin_master')
@section('title')
    Assign Subject Class
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assign Subject Classes <a href="{{ route('assign_subject.add') }}" class="float-right btn btn-sm btn-primary">Add Assign Subject<i class="typcn typcn-plus btn-icon-append"></i></a></h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($classes) > 0)

                                    @foreach($classes as $key => $class)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ !(empty($class->class->class_name))? $class->class->class_name : '' }}</td>

                                            <td>

                                                <a href="{{ route('assign_subject.edit', $class->class_id) }}" type="button" class="btn btn-success btn-sm btn-icon-text">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('assign_subject.details', $class->class_id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    Details
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>
                                                <a id="delete" href="{{ route('assign_subject_class.delete', $class->class_id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    Delete
                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                </a>
                                                <a href="{{  route('assign_subject_classes.pdf') }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
                                                    Print
                                                    <i class="typcn typcn-printer btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No subject class found.</h4></td>
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

