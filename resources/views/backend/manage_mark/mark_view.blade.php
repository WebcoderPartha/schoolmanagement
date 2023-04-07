@extends('layout.admin_master')
@section('title')
    Mark Mangement
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('student.search') }}" method="GET">
                    <div class="row search">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="form-group">
                                <label for="class_id">Subject</label>
                                <select class="form-control" name="subject_id" id="subject_id">
                                    <option value="">Select subject</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary" style="margin-top:30px">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student List <a href="" class="float-right btn btn-sm btn-primary">Register Student<i class="typcn typcn-plus btn-icon-append"></i></a></h4>



                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Name</th>
                                    <th>Student ID</th>
                                    <th>Roll</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                </tr>

{{--                                        <tr>--}}
{{--                                            <td>{{ $key+1 }}</td>--}}
{{--                                            <td>{{ $student->year->student_year }}</td>--}}
{{--                                            <td>{{ $student->class->class_name }}</td>--}}
{{--                                            <td>{{ (!empty($student)) ? $student->student->name : '' }}</td>--}}
{{--                                            <td>{{ $student->student->id_number }}</td>--}}
{{--                                            <td>{{ $student->roll_number }}</td>--}}
{{--                                            <td><img src="{{ (!empty($student->student->image))? asset($student->student->image) : '' }}" width="150" alt=""></td>--}}

{{--                                            <td>--}}

{{--                                                <a href="" type="button" class="btn btn-success btn-sm btn-icon-text">--}}
{{--                                                    <i class="typcn typcn-edit btn-icon-append"></i>--}}
{{--                                                </a>--}}
{{--                                               --}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                              --}}
{{--                                    <tr>--}}
{{--                                        <td colspan="4">  <h4 class="text-center">No student found.</h4></td>--}}
{{--                                    </tr>--}}


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $(document).on('change', '#class_id', function (){
                let class_id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('mark.class.subject') }}',
                    dataType:'JSON',
                    data: {'class_id': class_id},
                    success: function (data){
                        let html = '';
                        $.each(data.subjects, function(index, item){
                            html += '<option value='+item.subject_id+'>'+item.subject.name+'</option>';
                        });
                        if (data.subjects.length > 0){
                            $('#subject_id').html(html);
                        }else{
                            html +='<option >Select subject</option>';
                            $('#subject_id').html(html);
                        }

                    }
                });
            });
        });
    </script>
@endsection

