@extends('layout.admin_master')
@section('title')
    Edit Exam Fee
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Exam Fee</h4>
                    </div>
                    <div class="card-body">


                        <form class="forms-sample" method="POST" action="{{ route('exam.fees.update', ['year_id'=>$exams[0]->year_id, 'exam_type_id' => $exams[0]->exam_type_id]) }}">
                            @csrf
                            <div class="closestAdd">


                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="year_id">Student Year</label>
                                        <select name="year_id" class="form-control" id="year_id">
                                            <option value="">Select student year</option>
                                            @foreach($years as $year)
                                                <option {{($exams[0]->year_id == $year->id) ? 'selected' : ''}} value="{{ $year->id }}">{{ $year->student_year }}</option>
                                            @endforeach
                                        </select>
                                        @error('year_id')
                                        <small class="text-danger">
                                            <i>{{ $message }}</i>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                @foreach($exams as $exam)
                                    <div class="deleteEventItem">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="class_id" >Student Class</label>

                                                    <select class="form-control" name="class_id[]" id="class_id">
                                                        <option value="">Select Student Class</option>
                                                        @foreach($classes as $class)
                                                            <option {{ ($exam->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->class_name }}</option>
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
                                                    <label for="exam_type_id" >Exam Type</label>

                                                    <select class="form-control" name="exam_type_id[]" id="exam_type_id">
                                                        <option value="">Select exam type</option>
                                                        @foreach($examTypes as $examType)
                                                            <option {{ ($exam->exam_type_id == $examType->id) ? 'selected' : '' }} value="{{ $examType->id }}">{{ $examType->name }}</option>
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
                                                    <label for="fee_amount">Exam Fee Amount</label>
                                                    <input type="text" class="form-control" value="{{ $exam->fee_amount }}" name="fee_amount[]" placeholder="amount" id="amount">
                                                    @error('fee_amount')
                                                    <small class="text-danger">
                                                        <i>{{ $message }}</i>
                                                    </small>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded btn-icon addMore" style="margin-top: 30px;">
                                                    <i class="typcn typcn-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-rounded btn-icon deleteItem" style="margin-top: 30px;">
                                                    <i class="typcn typcn-minus"></i>
                                                </button>
                                            </div>
                                        </div> <!-- End Row -->
                                    </div><!-- End Romove Class -->
                                @endforeach


                            </div><!-- End Add Class -->


                            <div class="form-group row mt-3">
                                <div class="col-sm-12 p-4 text-center">
                                    <button type="submit" class="btn btn-primary mr-2">Update Exam Fee</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="addEventItem" style="display: none">
        <div class="deleteEventItem">
            <div class="row mt-2">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="class_id" >Student Class</label>

                        <select class="form-control" name="class_id[]" id="class_id">
                            <option value="">Select student class</option>
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
                        <label for="exam_type_id" >Exam Type</label>

                        <select class="form-control" name="exam_type_id[]" id="exam_type_id">
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
                        <label for="amount">Exam Fee Amount</label>
                        <input type="text" class="form-control" name="fee_amount[]" placeholder="amount" id="amount">
                        @error('fee_amount')
                        <small class="text-danger">
                            <i>{{ $message }}</i>
                        </small>
                        @enderror

                    </div>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-primary btn-sm btn-rounded btn-icon addMore" style="margin-top: 30px;">
                        <i class="typcn typcn-plus"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-rounded btn-icon deleteItem" style="margin-top: 30px;">
                        <i class="typcn typcn-minus"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function (){
            let counter = 0;

            $(document).on('click', '.addMore', function (e){
                e.preventDefault();
                let addEventItem = $('.addEventItem').html();
                $(this).closest('.closestAdd').append(addEventItem);
                counter++;
            });

            $(document).on('click', '.deleteItem', function (e){
                e.preventDefault();
                $(this).closest('.deleteEventItem').remove();
                counter -= 1;
            });
        })
    </script>
@endsection

