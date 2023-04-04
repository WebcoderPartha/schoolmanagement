
<!DOCTYPE html>
<html>
<head>
    <title>Employee Detail</title>
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
        <p>Employee Details</p>
    </div>

    <table id="customers">

        <tr>
            <td colspan="4" align="center"><img width="250" src="data:image/jpg;base64,{{ $image }}" alt=""></td>
        </tr>
        <tr>
            <td colspan="2">Employee ID:</td>
            <td colspan="2"><b>{{ $employee->id_number }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Designation:</td>
            <td colspan="2"><b>{{ $employee->designation->name }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Salary:</td>
            <td colspan="2"><b>{{ $employee->salary }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Joining Date:</td>
            <td colspan="2"><b>{{ $employee->joining_date }}</b></td>
        </tr>
{{--        <tr>--}}
{{--            <td colspan="2">Year:</td>--}}
{{--            <td colspan="2"><b>{{ $student->year->student_year }}</b></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">Class:</td>--}}
{{--            <td colspan="2"><b>{{ $student->class->class_name }}</b></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">Group:</td>--}}
{{--            <td colspan="2"><b>{{ $student->group->student_group }}</b></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="2">Shift:</td>--}}
{{--            <td colspan="2"><b>{{ $student->shift->student_shift }}</b></td>--}}
{{--        </tr>--}}
        <tr>
            <td>Name:</td>
            <td>{{ $employee->name }}</td>
            <td>Father Name:</td>
            <td>{{ $employee->father_name }}</td>
        </tr>
        <tr>
            <td>Date Of Birth:</td>
            <td>{{ $employee->date_of_birth }}</td>
            <td>Religion:</td>
            <td>{{ $employee->religion }}</td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td>{{ $employee->gender }}</td>
            <td>Email:</td>
            <td>{{ (!empty($employee->email)) ? $employee->email : '' }}</td>
        </tr>
        <tr>
            <td>Mobile:</td>
            <td>{{ $employee->phone }}</td>
            <td>Address:</td>
            <td>{{ $employee->address }}</td>
        </tr>



    </table>
</div>
</body>
</html>


