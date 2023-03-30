@extends('layout.admin_master')
@section('title')
    Assign Subject Add
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Assign Subjects</h4>
                        <form class="forms-sample" method="post" action="{{ route('assign_subject.store') }}">
                            @csrf
                            <div class="closestItem">
                                <div class="row">
                                   <div class="form-group col-sm-6">
                                       <label for="class_id">Class</label>
                                       <select name="class_id" class="form-control" id="class_id">
                                           <option value="">Select subject class..</option>
                                           @foreach($allClasses as $class)
                                               <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                           @endforeach
                                       </select>
                                       @error('class_id')
                                       <small class="text-danger">
                                           <i>{{ $message }}</i>
                                       </small>
                                       @enderror
                                   </div>
                                   <div class="form-group col-sm-6">
                                   </div>
                                   <div class="form-group col-sm-4 mt-2">
                                       <label for="subject_id">Assign subject</label>
                                       <select name="subject_id[]" class="form-control" id="subject_id">
                                           <option value="">Select assign subject..</option>
                                           @foreach($allSubjects as $subject)
                                               <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                           @endforeach
                                       </select>
                                       @error('subject_id')
                                       <small class="text-danger">
                                           <i>{{ $message }}</i>
                                       </small>
                                       @enderror
                                   </div>
                                   <div class="form-group col-sm-2 mt-2">
                                       <label for="full_mark">Full Mark</label>
                                       <input type="text" class="form-control" name="full_mark[]" id="full_mark" placeholder="Full mark">
                                       @error('full_mark')
                                       <small class="text-danger">
                                           <i>{{ $message }}</i>
                                       </small>
                                       @enderror
                                   </div>
                                   <div class="form-group col-sm-2 mt-2">
                                       <label for="pass_mark">Pass Mark</label>
                                       <input type="text" class="form-control" name="pass_mark[]" id="pass_mark" placeholder="Pass mark">
                                       @error('pass_mark')
                                       <small class="text-danger">
                                           <i>{{ $message }}</i>
                                       </small>
                                       @enderror
                                   </div>
                                   <div class="form-group col-sm-2 mt-2">
                                       <label for="subjective_mark">Subjective Mark</label>
                                       <input type="text" class="form-control" name="subjective_mark[]" id="subjective_mark" placeholder="Subjective mark">
                                       @error('subjective_mark')
                                       <small class="text-danger">
                                           <i>{{ $message }}</i>
                                       </small>
                                       @enderror
                                   </div>
                                   <div class="form-group col-sm-2 mt-2" style="margin-top: 40px !important;">
                                       <button type="button" class="btn btn-info btn-rounded btn-icon addSubject">
                                           <i class="typcn typcn-plus"></i>
                                       </button>
                                   </div>
                                </div> <!-- End row -->
                           </div> <!-- Closest end -->

                                <div class="row">
                                    <div class="form-group col-sm-12 mt-5">
                                       <button  type="submit" class="btn btn-primary">Assign Subject</button>
                                       <a href="" class="btn btn-success">Back</a>
                                   </div>
                               </div> <!-- End row-->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Adding ITEM --->
    <div class="addingItem" style="display: none">
        <div class="removingItem">
            <div class="row">
                <div class="form-group col-sm-4 mt-2">
                    <label for="subject_id">Assign subject</label>
                    <select name="subject_id[]" class="form-control" id="subject_id">
                        <option value="">Select assign subject..</option>
                        @foreach($allSubjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <small class="text-danger">
                        <i>{{ $message }}</i>
                    </small>
                    @enderror
                </div>
                <div class="form-group col-sm-2 mt-2">
                    <label for="full_mark">Full Mark</label>
                    <input type="text" class="form-control" name="full_mark[]" id="full_mark" placeholder="Full mark">
                    @error('full_mark')
                    <small class="text-danger">
                        <i>{{ $message }}</i>
                    </small>
                    @enderror
                </div>
                <div class="form-group col-sm-2 mt-2">
                    <label for="pass_mark">Pass Mark</label>
                    <input type="text" class="form-control" name="pass_mark[]" id="pass_mark" placeholder="Pass mark">
                    @error('pass_mark')
                    <small class="text-danger">
                        <i>{{ $message }}</i>
                    </small>
                    @enderror
                </div>
                <div class="form-group col-sm-2 mt-2">
                    <label for="subjective_mark">Subjective Mark</label>
                    <input type="text" class="form-control" name="subjective_mark[]" id="subjective_mark" placeholder="Subjective mark">
                    @error('subjective_mark')
                    <small class="text-danger">
                        <i>{{ $message }}</i>
                    </small>
                    @enderror
                </div>
                <div class="form-group col-sm-2 mt-2" style="margin-top: 40px !important;">
                    <button type="button" class="btn btn-info btn-rounded btn-icon addSubject">
                        <i class="typcn typcn-plus"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-rounded btn-icon addMinusSubject">
                        <i class="typcn typcn-minus"></i>
                    </button>
                </div>
            </div> <!-- End row -->
        </div>
    </div>
    <!-- End Adding ITEM --->

    <script type="text/javascript">
        $(document).ready(function(){
            let counter = 0;
            $(document).on('click', '.addSubject', function (e){
                e.preventDefault();
                let addingItem = $('.addingItem').html();
                $(this).closest('.closestItem').append(addingItem);
                counter++;
            });

            $(document).on('click', '.addMinusSubject', function (e){
                e.preventDefault();
                $(this).closest('.removingItem').remove();
                counter -=1;
            })
        });
    </script>
@endsection

