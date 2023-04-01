@extends('layout.admin_master')
@section('title')
    Roll Generate
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                    <div class="row search">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="year_id">Year</label>
                                <select class="form-control" name="year_id" id="year_id">
                                    <option value="">Select year</option>
                                    @foreach($years as $year)
                                        <option

                                            value="{{ $year->id }}">{{ $year->student_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select class</option>
                                    @foreach($classes as $class)
                                        <option

                                            value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4"><button type="button" class="btn btn-primary" id="searchButton" style="margin-top:30px">Search</button></div>
                    </div>
            </div>
        </div>
        <div class="row d-none" id="studentListTable">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student List </h4>

                        <div class="table-respnsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Name</th>
                                    <th>Student ID</th>
                                    <th>Roll</th>
                                </tr>
                                </thead>

                                <tbody class="rollGenerateShow">




                                </tbody>
                            </table>
                                <div class="text-center d-block">
                                    <button class="btn btn-warning text-white mt-3" type="button" id="RoleGenerateButton">Roll Generate</button>
                                </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function(){

            // Search Year Class wise Student for Roll Generate
            $('#searchButton').click(function(){
                let class_id = $('#class_id').val();
                let year_id = $('#year_id').val();
                let sl= 0;
                $.ajax({
                    type: 'GET',
                    url: "{{ route('role.generate.search') }}",
                    data: {year_id: year_id, class_id: class_id},
                    dataType: 'JSON',
                    success: function (data){
                        $('#studentListTable').removeClass('d-none');
                        let sl = 0;
                        let html = '';
                        $.each(data, function(index, value){

                            html += "<tr>";
                            html += "<td>"+value.year.student_year+"</td>";
                            html += "<td>"+value.class.class_name+"</td>";
                            html += "<td>"+value.student.name+"</td>";
                            html += "<td>"+value.student.id_number+"</td>";
                            html += "<td><input style='width: 130px !important;' type='text' value='"+value.roll_number+"'  class='form-control roll_number' name='roll_number[]'><input style='width: 130px !important;' type='hidden' value='"+value.student_id+"'  class='form-control' name='student_id[]'></td>";
                            html += "</tr>";

                        });

                       $('.rollGenerateShow').html(html);

                    },
                    error: function (error){
                        console.log(error)
                    }
                });
            }); // End Search Year Class wise Student for Roll Generate

            $('#RoleGenerateButton').click(function (e){

                let roll_number = $("input[name='roll_number[]']").map(function (){
                    return this.value;
                }).get();
                let student_id = $("input[name='student_id[]']").map(function (){
                    return this.value;
                }).get();
                let year_id = $('#year_id').val();
                let class_id = $('#class_id').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('role.generate.store') }}",
                    data: {roll_number,student_id ,class_id, year_id, _token: '{{csrf_token()}}'},
                    success: function (response){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.success,
                            showConfirmButton: false,
                            timer: 2000
                        });
                       window.location = "{{ route('role.generate.view') }}"

                    }
                });
            })

        });
    </script>
@endsection

