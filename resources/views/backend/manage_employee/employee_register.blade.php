@extends('layout.admin_master')
@section('title')
    Employee Registration
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4> Employee Register</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.register.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Student Name">
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
                                <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father Name">
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
                                <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name">
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
                                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth">
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
                                    <option value="Islam">Islam</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddhist">Buddhist</option>
                                    <option value="Christan">Christan</option>
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
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
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
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email address">
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
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number">
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
                                <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
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
                                        <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="text" class="form-control" name="salary" id="salary" placeholder="Salary">
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
                                <input type="date" class="form-control" name="joining_date" id="joining_date">
                                @error('joining_date')
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
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <img src="" width="150" id="showImage" alt="">
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    <div class="row mt-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" value="Employee Register">
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

