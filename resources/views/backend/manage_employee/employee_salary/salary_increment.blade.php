@extends('layout.admin_master')
@section('title')
    Employee Increment Salary
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4>Employee Salary Increment</h4>
                <hr>
                <h6>Employee ID: <b>{{ $employee->id_number }}</b></h6>
                <h6>Employee Name: <b>{{ $employee->name }}</b></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.salary_increment_store', $employee->id) }}">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="increment_salary">Increment Salary Amount</label>
                                <input type="text" class="form-control" name="increment_salary" id="increment_salary" placeholder="Increment salary amount">
                                @error('increment_salary')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="effected_salary_date">Effected Salary Date</label>
                                <input type="date" class="form-control" name="effected_salary_date" id="effected_salary_date">
                                @error('effected_salary_date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- End Row -->


                    <div class="row mt-4">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-info">Confirm Increment Salary</button>
                        </div>

                        <div class="col-sm-4">

                        </div>
                    </div> <!-- End Row -->


                </form>
            </div>
        </div>
    </div>



@endsection

