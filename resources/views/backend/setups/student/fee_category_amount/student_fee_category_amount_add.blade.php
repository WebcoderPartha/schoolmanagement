@extends('layout.admin_master')
@section('title')
    Add Fee Amount
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Fee Amount</h4>
                        <form class="forms-sample" method="POST" action="{{ route('student.fcamount.store') }}">
                            @csrf
                            <div class="closestAdd">

                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="fee_category_id">Fee Category</label>
                                            <select name="fee_category_id" class="form-control" id="fee_category_id">
                                                <option value="">Select Fee Category</option>
                                                @foreach($feeCats as $feeCat)
                                                 <option value="{{ $feeCat->id }}">{{ $feeCat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('fee_category_id')
                                            <small class="text-danger">
                                                <i>{{ $message }}</i>
                                            </small>
                                            @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="student_class_id" >Student Class</label>

                                                <select class="form-control" name="student_class_id" id="student_class_id">
                                                    <option value="">Select Student Class</option>
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('student_class_id')
                                                <small class="text-danger">
                                                    <i>{{ $message }}</i>
                                                </small>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="amount">Fee Amount</label>
                                            <input type="text" class="form-control" name="amount" placeholder="amount" id="amount">
                                                @error('amount')
                                                <small class="text-danger">
                                                    <i>{{ $message }}</i>
                                                </small>
                                                @enderror

                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded btn-icon addMore" style="margin-top: 30px;">
                                            <i class="typcn typcn-plus"></i>
                                        </button>

                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mt-5">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary mr-2">Add Fee Amount</button>
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
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="student_class_id" >Student Class</label>

                        <select class="form-control" name="student_class_id" id="student_class_id">
                            <option value="">Select Student Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                        @error('student_class_id')
                        <small class="text-danger">
                            <i>{{ $message }}</i>
                        </small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="amount">Fee Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="amount" id="amount">
                        @error('amount')
                        <small class="text-danger">
                            <i>{{ $message }}</i>
                        </small>
                        @enderror

                    </div>
                </div>
                <div class="col-sm-2">
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

