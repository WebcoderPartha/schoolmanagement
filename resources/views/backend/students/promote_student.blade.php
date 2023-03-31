@extends('layout.admin_master')
@section('title')
    Student Promotion
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header text-center">
                <h4>Promote Student</h4>
                <h6>SID: {{ $student->id_number }}</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('student.promotion.update', $student->id) }}">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">Student Name</label>
                                <input type="text" disabled value="{{ $student->name }}" class="form-control" name="name" id="name" placeholder="Student Name">
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
                                <input disabled type="text" value="{{ $student->father_name }}" class="form-control" name="father_name" id="father_name" placeholder="Father Name">
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
                                <input disabled type="text" value="{{ $student->mother_name }}" class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name">
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
                                <label disabled for="dateofbirth">Date Of Birth</label>
                                <input disabled type="date" value="{{ $student->dateofbirth }}" class="form-control" name="dateofbirth" id="dateofbirth">
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
                                <select disabled class="form-control" name="religion" id="religion">
                                    <option value="">Select Religion</option>
                                    <option selected value="{{ $student->religion }}">{{ $student->religion }}</option>
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
                                <select disabled class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="{{ $student->gender }}" selected>{{ $student->gender }}</option>
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
                                <input disabled type="email" value="{{ $student->email }}" class="form-control" name="email" id="email" placeholder="Email address">
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
                                <input disabled type="text" value="{{ $student->phone }}" class="form-control" name="phone" id="phone" placeholder="Phone number">
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
                                <textarea disabled class="form-control" name="address" id="address" placeholder="Address">{{ $student->address }}</textarea>
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
                                        <option
                                            @if($assignStudent->year_id == $year->id) selected @endif
                                        value="{{ $year->id }}">{{ $year->student_year }}</option>
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
                                        <option
                                            @if($assignStudent->class_id == $class->id) selected @endif
                                        value="{{ $class->id }}">{{ $class->class_name }}</option>
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
                                        <option
                                            @if($assignStudent->group_id == $group->id) selected @endif
                                        value="{{ $group->id }}">{{ $group->student_group }}</option>
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
                                        <option
                                            @if($assignStudent->shift_id == $shift->id) selected @endif
                                        value="{{ $shift->id }}">{{ $shift->student_shift }}</option>
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
                                <label for="fee_category_id">Discount Category</label>
                                <select class="form-control" name="fee_category_id" id="fee_category_id">
                                    <option value="">Select discount category</option>
                                    @foreach($fee_categories as $feecat)
                                        <option
                                            @if($discount->fee_category_id == $feecat->id) selected @endif
                                        value="{{ $feecat->id }}">{{ $feecat->name }}</option>
                                    @endforeach
                                </select>
                                @error('fee_category_id')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="text" value="{{ $discount->discount }}" class="form-control" name="discount" id="discount" placeholder="Discount percentage">
                                @error('discount')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- End Row -->


                    <div class="row mt-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" value="Promote Student">
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

