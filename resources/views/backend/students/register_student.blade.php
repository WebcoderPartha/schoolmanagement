@extends('layout.admin_master')
@section('title')
    Student Registration
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4>Student Registration</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('student.regi.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">Student Name</label>
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
                                <label for="dateofbirth">Date Of Birth</label>
                                <input type="date" class="form-control" name="dateofbirth" id="dateofbirth">
                                @error('dateofbirth')
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="group_id">Group</label>
                                <select class="form-control" name="group_id" id="group_id">
                                    <option value="">Select group</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->student_group }}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
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
                                <label for="shift_id">Shift</label>
                                <select class="form-control" name="shift_id" id="shift_id">
                                    <option value="">Select shift</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->student_shift }}</option>
                                    @endforeach
                                </select>
                                @error('shift_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="discount_percentage">Registration Fee (Discount %)</label>
                                <input type="text" class="form-control" name="discount_percentage" id="discount_percentage" placeholder="Discount percentage">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>
                    </div> <!-- End Row -->

                    <div class="row mt-2">

                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <img src="" width="150" id="showImage" alt="">
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    <div class="row mt-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" value="Confirm Registration">
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

