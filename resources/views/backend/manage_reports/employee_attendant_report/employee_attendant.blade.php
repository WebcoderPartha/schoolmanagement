@extends('layout.admin_master')
@section('title')
    Employee Attendant
@endsection

@section('content')
    <div class="content-wrapper">
        <form action="{{ route('reports.employee_attendant_view') }}" method="get">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row search">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select class="form-control" name="employee_id" id="employee_id">
                                    <option value="">Select employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date">
                                @error('date')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 mx-auto">
                            <button type="submit" id="searchStudent" class="btn btn-primary" style="margin-top:30px">Search</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>


@endsection

