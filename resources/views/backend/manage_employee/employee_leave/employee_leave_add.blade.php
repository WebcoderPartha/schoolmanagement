@extends('layout.admin_master')
@section('title')
    Add Employee Leave
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4>Add Employee Leave</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.leave_store') }}">
                    @csrf
                    <div class="row mt-2">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="employee_id">Employee Name</label>
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

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="leave_purpose_id">Leave Purpose</label>
                                <select class="form-control mb-3" name="leave_purpose_id" id="leave_purpose_id">
                                    <option value="">Select leave purpose</option>
                                        @foreach($leave_purposes as $leave)
                                            <option value="{{ $leave->id }}">{{ $leave->name }}</option>
                                        @endforeach
                                    <option value="0">New Purpose</option>
                                </select>
                                <input type="text" class="form-control" style="display: none" name="name" placeholder="Type purpose" id="addNewPurpose">
                                @error('leave_purpose_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>


                    </div> <!-- End Row -->

                    <div class="row mt-2">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                                @error('start_date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                                @error('end_date')
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
                            <button type="submit" class="btn btn-info">Add Leave Employee</button>
                        </div>

                        <div class="col-sm-4">

                        </div>
                    </div> <!-- End Row -->


                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change', '#leave_purpose_id', function (e){
                e.preventDefault();
                let leave_purpose_id = $(this).val();
                if (leave_purpose_id === '0'){
                    $('#addNewPurpose').show();
                }else{
                    $('#addNewPurpose').hide();
                }
            });
        });
    </script>

@endsection

