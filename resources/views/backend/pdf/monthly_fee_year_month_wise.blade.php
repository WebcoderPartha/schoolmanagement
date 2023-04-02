<!DOCTYPE html>
<html>
<head>
    <title>Registration Fee details</title>
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
            text-align: center;
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
        <p>Monthly Fee</p>
        <p>{{$allData[0]->month->name }} - {{$allData[0]->year->student_year}}</p>
    </div>

    <table id="customers" style="text-align: center !important;">
        {{--            <tr>--}}
        {{--                <th>Company</th>--}}
        {{--                <th>Contact</th>--}}
        {{--                <th>Country</th>--}}
        {{--            </tr>--}}

        <tr>
            <th>SL</th>
            <th>Class</th>
            <th>Registration Fee</th>
        </tr>

        @foreach($allData as $key => $regiFee)
        <tr>

            <td>{{ $key+1 }}</td>
            <td>{{$regiFee->class->class_name}}</td>
            <td>{{$regiFee->fee_amount}}</td>

        </tr>


        @endforeach

    </table>
</div>
</body>
</html>


