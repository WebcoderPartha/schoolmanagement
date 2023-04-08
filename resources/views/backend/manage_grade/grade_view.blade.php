@extends('layout.admin_master')
@section('title')
    Manage Grade
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Grade List <a href="{{ route('grades.add') }}" class="btn btn-primary float-right">Add Grade</a></h4>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Grade Name</th>
                                    <th>Grade Point</th>
                                    <th>Start Mark</th>
                                    <th>End Mark</th>
                                    <th>Point Range</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($grades) > 0)
                                    @foreach($grades as $key => $grade)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $grade->grade_name }}</td>
                                            <td>{{ $grade->grade_point }}</td>
                                            <td>{{ $grade->start_marks }}</td>
                                            <td>{{ $grade->end_marks }}</td>
                                            <td>{{ $grade->start_point }} - {{ $grade->end_point }}</td>
                                            <td>{{ $grade->remarks }}</td>
                                            <td>

                                                <a href="{{ route('grades.edit', $grade->id) }}" type="button" class="btn btn-sm btn-warning btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('grades.delete', $grade->id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">  <h4 class="text-center">No grades found.</h4></td>
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

