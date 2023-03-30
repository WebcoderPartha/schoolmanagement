@extends('layout.admin_master')
@section('title')
    Assign Class Subject Details
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><b>{{$assSubjectsClass[0]->class->class_name}}</b> Subject List<a href="" class="float-right btn btn-sm btn-primary">Print<i class="typcn typcn-printer btn-icon-append"></i></a></h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Subject</th>
                                    <th>Full Mark</th>
                                    <th>Pass Mark</th>
                                    <th>Subjective Mark</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($assSubjectsClass) > 0)

                                    @foreach($assSubjectsClass as $key => $subject)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $subject->subject->name }}</td>
                                            <td>{{ $subject->full_mark }}</td>
                                            <td>{{ $subject->pass_mark }}</td>
                                            <td>{{ $subject->subjective_mark }}</td>

                                            <td>

                                                <a id="delete" href="{{ route('assign_subject.delete', $subject->id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    Delete
                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No class subject found.</h4></td>
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

