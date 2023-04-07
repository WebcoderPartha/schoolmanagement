@extends('layout.admin_master')
@section('title')
    Mark Mangement
@endsection
<style type="text/css">
    input#marks {
        box-shadow: 2px 1px 3px 2px #ddd;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <form action="{{ route('marks.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
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
                                        <option selected value="">Select subject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="exam_type_id">Exam Type</label>
                                    <select class="form-control" name="exam_type_id" id="exam_type_id">
                                        <option selected value="">Select subject</option>
                                        @foreach($examTypes as $examType)
                                            <option value="{{ $examType->id }}">{{ $examType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 mx-auto">
                                <button type="submit" id="searchStudent" class="btn btn-primary" style="margin-top:30px">Search</button>
                            </div>
                        </div>

                </div>
            </div>
            <div class="row" id="studentMarkContent" style="display: none">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student Mark Entry</h4>



                            <div class="table-respnsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>SID</th>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Mark</th>
                                    </tr>
                                    </thead>
                                    <tbody class="markGenerate">


                                    </tbody>
                                </table>
                            </div>
                           <div class="submit mx-auto text-center">
                               <input class="btn btn-success" type="submit" value="Mark Entry">
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){

            // Class subject
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
                            html +='<option value="">Select subject</option>';
                            html += '<option value='+item.subject_id+'>'+item.subject.name+'</option>';
                        });
                        if (data.subjects.length > 0){
                            $('#subject_id').html(html);
                        }else{
                            html +='<option value="">Select subject</option>';
                            $('#subject_id').html(html);
                        }

                    }
                });
            });

            $(document).on('click', '#searchStudent', function (e){
                e.preventDefault();
                let year_id = $('#year_id').val();
                let class_id = $('#class_id').val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('assignStudentGet') }}',
                    dataType: 'JSON',
                    data: {year_id, class_id},
                    success:function (data){
                        let html = '';
                        $('#studentMarkContent').show();
                        $.each(data, function(index, item){

                            html += "<tr>";
                            html += "<td>"+item.student.id_number+" <input type='hidden' value="+item.student.id_number+" name='id_number[]'></td>";
                            html += "<td>"+item.student.name+"<input type='hidden' value="+item.student.id+" name='student_id[]'></td></td>";
                            html += "<td>"+item.year.student_year+"</td>";
                            html += "<td>"+item.class.class_name+"</td>";
                            html += "<td><input style='width: 130px !important;' type='text' value=''  id='marks' class='form-control' placeholder='Enter mark' name='marks[]'></td>";
                            html += "</tr>";
                        });
                        $('.markGenerate').html(html);
                    }
                });
            });
        });
    </script>
@endsection

