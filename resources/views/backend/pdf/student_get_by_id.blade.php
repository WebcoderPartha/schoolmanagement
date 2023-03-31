<!DOCTYPE html>
<html>
<head>
    <title>Studet Detail</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        .main_container{
            width: 800px;
            margin: 40px auto;
            max-width: 100%;
        }
        .header {
            background-color: #04AA6D;
            color: #fff;
            text-align: center;
            padding: 20px 0px;
        }
        .header h2 {
            margin: 0;
            padding: 0px;
        }
        .header p {
            margin: 0;
            font-size: 24px;
            margin-top: 5px;
        }

    </style>
</head>
<body>
<div class="main_container">
    <div class="header">
        <h2>STUDENT MANAGEMENT SYSTEM</h2>
        <p>Student Details</p>
    </div>

    <table id="customers">
        {{--            <tr>--}}
        {{--                <th>Company</th>--}}
        {{--                <th>Contact</th>--}}
        {{--                <th>Country</th>--}}
        {{--            </tr>--}}
        <tr>
            <td colspan="4" align="center"><img width="250" src="data:image/jpg;base64,{{ $image }}" alt=""></td>
        </tr>
        <tr>
            <td colspan="2">Student ID:</td>
            <td colspan="2"><b>{{ $student->id_number }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Roll Number:</td>
            <td colspan="2">{{ $student->roll }}</td>
        </tr>
        <tr>
            <td colspan="2">Year:</td>
            <td colspan="2"><b>{{ $student->year->student_year }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Class:</td>
            <td colspan="2">{{ $student->class->class_name }}</td>
        </tr>
        <tr>
            <td colspan="2">Group:</td>
            <td colspan="2"><b>{{ $student->group->student_group }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Shift:</td>
            <td colspan="2"><b>{{ $student->shift->student_shift }}</b></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td>{{ $student->name }}</td>
            <td>Father Name:</td>
            <td>{{ $student->father_name }}</td>
        </tr>
        <tr>
            <td>Date Of Birth:</td>
            <td>{{ $student->dateofbirth }}</td>
            <td>Religion:</td>
            <td>{{ $student->religion }}</td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td>{{ $student->gender }}</td>
            <td>Email:</td>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <td>Mobile:</td>
            <td>{{ $student->phone }}</td>
            <td>Address:</td>
            <td>{{ $student->address }}</td>
        </tr>



    </table>
</div>
</body>
</html>


