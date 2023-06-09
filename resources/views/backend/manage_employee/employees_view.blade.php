@extends('layout.admin_master')
@section('title')
    Employee List
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee List <a href="{{ route('employees.register') }}" class="float-right btn btn-sm btn-primary">Register Employee<i class="typcn typcn-plus btn-icon-append"></i></a></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
                                    <th>Salary</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($employees) > 0)

                                    @foreach($employees as $key => $employee)

                                        <tr>
                                            <td>{{ $employee->id_number }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->designation->name }}</td>
                                            <td>{{ $employee->joining_date }}</td>
                                            <td>{{ $employee->salary }}</td>
                                            <td><img src="{{ (!empty($employee->image))? asset($employee->image) : '' }}" width="150" alt=""></td>

                                            <td>

                                                <a href="{{ route('employee.edit', $employee->id_number) }}" class="btn btn-success btn-sm btn-icon-text">
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('employee.detail', $employee->id_number) }}" class="btn btn-sm btn-primary btn-icon-text">
                                                    <i class="typcn typcn-eye btn-icon-append"></i>
                                                </a>

                                                <a id="delete" href="{{ route('employee.delete', $employee->id_number) }}" type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                    <i class="typcn typcn-trash btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('employee.idCard', $employee->id_number) }}" target="_blank" class="btn btn-sm btn-primary btn-icon-text">
                                                    <i class="typcn typcn-printer btn-icon-append"> ID Card</i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">  <h4 class="text-center">No Employee found.</h4></td>
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

