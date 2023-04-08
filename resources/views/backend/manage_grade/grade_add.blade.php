@extends('layout.admin_master')
@section('title')
    Grade Add
@endsection

@section('content')
    <div class="content-wrapper">
        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row search">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="grade_name">Grade Name</label>
                                <input type="text" name="grade_name" class="form-control" id="grade_name" placeholder="Enter grade name">
                                @error('grade_name')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="grade_point">Grade Point</label>
                                <input type="text" name="grade_point" class="form-control" id="grade_point" placeholder="Enter grade point">
                                @error('grade_point')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="start_marks">Start Marks</label>
                                <input type="text" name="start_marks" class="form-control" id="start_marks" placeholder="Enter start marks">
                                @error('start_marks')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="end_marks">End Marks</label>
                                <input type="text" name="end_marks" class="form-control" id="end_marks" placeholder="Enter end marks">
                                @error('end_marks')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="start_point">Start Point</label>
                                <input type="text" name="start_point" class="form-control" id="start_point" placeholder="Enter start point">
                                @error('start_point')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="end_point">End Point</label>
                                <input type="text" name="end_point" class="form-control" id="end_point" placeholder="Enter end point">
                                @error('end_point')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Enter remarks">
                                @error('remarks')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3 mx-auto">
                            <button type="submit" class="btn btn-primary" style="margin-top:30px">Add Grade</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection

