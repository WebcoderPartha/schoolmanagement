@extends('layout.admin_master')
@section('title')
    Edit Employee Registration
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4> Edit Employee Register</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.update', ['id_number'=> $employee->id_number]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $employee->name }}" class="form-control" name="name" id="name" placeholder="Student Name">
                                @error('name')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="father_name">Father Name</label>
                                <input type="text" value="{{ $employee->father_name }}" class="form-control" name="father_name" id="father_name" placeholder="Father Name">
                                @error('father_name')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="mother_name">Mother Name</label>
                                <input type="text" value="{{ $employee->mother_name }}" class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name">
                                @error('mother_name')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- End Row -->

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="date_of_birth">Date Of Birth</label>
                                <input type="date" value="{{ date('Y-m-d', strtotime($employee->date_of_birth)) }}" class="form-control" name="date_of_birth" id="date_of_birth">
                                @error('date_of_birth')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <select class="form-control" name="religion" id="religion">
                                    <option value="">Select Religion</option>
                                    <option {{ ($employee->religion == 'Islam') ? 'selected' : '' }} value="Islam">Islam</option>
                                    <option {{ ($employee->religion == 'Hindu') ? 'selected' : '' }} value="Hindu">Hindu</option>
                                    <option {{ ($employee->religion == 'Buddhist') ? 'selected' : '' }} value="Buddhist">Buddhist</option>
                                    <option {{ ($employee->religion == 'Christan') ? 'selected' : '' }} value="Christan">Christan</option>
                                </select>
                                @error('religion')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option {{ ($employee->gender == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{ ($employee->gender == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- End Row -->

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $employee->email }}" class="form-control" name="email" id="email" placeholder="Email address">
                                @error('email')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" value="{{ $employee->phone }}" class="form-control" name="phone" id="phone" placeholder="Phone number">
                                @error('phone')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Address">{{ $employee->address }}</textarea>
                                @error('address')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- End Row -->

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="designation_id">Designation</label>
                                <select class="form-control" name="designation_id" id="designation_id">
                                    <option value="">Select year</option>
                                    @foreach($designations as $designation)
                                        <option {{ ($employee->designation_id == $designation->id) ? 'selected' : '' }} value="{{ $designation->id }}">{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        @if(!$employee)
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="text" value="{{ $employee->salary }}" class="form-control" name="salary" id="salary" placeholder="Salary">
                                @error('salary')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="joining_date">Joining Date</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime($employee->joining_date)) }}" name="joining_date" id="joining_date">
                                @error('joining_date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        @endif

                    </div> <!-- End Row -->

                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <img src="{{ (!empty($employee->image))? asset($employee->image) :'' }}" width="150" id="showImage" alt="">
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    <div class="row mt-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" value="Update Employee Register">
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection

