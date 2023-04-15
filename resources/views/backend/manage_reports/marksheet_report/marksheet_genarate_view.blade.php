@extends('layout.admin_master')
@section('title')
    Marksheet Generate
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Marksheet Generate</h4>
            </div>
            <div class="card-body">
                <form action="{{route('reports.marksheet_search')}}" method="GET" target="_blank">
                    <div class="row search">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                                @error('year_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="exam_type_id">Exam Type</label>
                                <select class="form-control" name="exam_type_id" id="exam_type_id">
                                    <option value="">Select exam type</option>
                                    @foreach($examTypes as $examType)
                                        <option value="{{ $examType->id }}">{{ $examType->name }}</option>
                                    @endforeach
                                </select>
                                @error('exam_type_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="id_number">Student ID Number</label>
                                <input class="form-control" type="text" name="id_number" placeholder="ID number">
                                @error('id_number')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2 mx-auto"><button type="submit" class="btn btn-primary" id="searchButton" style="margin-top:30px">Generate</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

