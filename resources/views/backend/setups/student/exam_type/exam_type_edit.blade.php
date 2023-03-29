@extends('layout.admin_master')
@section('title')
    Edit Exam Type
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Exam Type List</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Exam Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($examTypes))
                                    @foreach($examTypes as $key => $exam)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $exam->name }}</td>
                                            <td>

                                                <a href="{{ route('exam_type.edit', $exam->id) }}" type="button" class="btn btn-warning btn-sm btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-prepend"></i>
                                                    Edit
                                                </a>
                                                <a id="delete" href="{{ route('exam_type.delete', $exam->id) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="typcn typcn-delete-outline btn-icon-prepend"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">  <h4 class="text-center">No exam found.</h4></td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Exam</h4>
                        <form class="forms-sample" method="POST" action="{{ route('exam_type.update', $examType->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Exam Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ $examType->name }}" class="form-control" name="name" id="name" placeholder="Exam name">
                                    @error('name')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Update Exam</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

