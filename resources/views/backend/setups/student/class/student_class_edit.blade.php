@extends('layout.admin_master')
@section('title')
    Edit Class
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">


            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Class</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.class.update', $studentClass->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="class_name" class="col-sm-3 col-form-label">Class Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $studentClass->class_name }}" name="class_name" id="class_name" placeholder="Class name">
                                    @error('class_name')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

