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
        <p>Student Registration Pay Slip</p>
    </div>

    <table id="customers" style="text-align: center !important;">
        {{--            <tr>--}}
        {{--                <th>Company</th>--}}
        {{--                <th>Contact</th>--}}
        {{--                <th>Country</th>--}}
        {{--            </tr>--}}

        <tr>
            <th>STD</th>
            <th>Session</th>
            <th>Class</th>
            <th>Name</th>
            <th>Roll</th>
            <th>Registration Fee</th>
        </tr>

        <tr>
            @php
                $discount = \App\Models\Discount::where('student_id', $student->student->id)->first();
                $discountParcent = $discount->discount;
                $regiFee = \App\Models\FeeCategoryAmount::where('fee_category_id', $discount->fee_category_id)->where('student_class_id', $student->class_id)->first();
                $RegistrationFee = $regiFee->amount;
                $parentAmount = ((float)$RegistrationFee*(float)$discountParcent)/100;
                $finalAmount = $RegistrationFee - $parentAmount;
            @endphp
            <td rowspan="3">{{ $student->student->id_number }}</td>
            <td rowspan="3">{{ $student->year->student_year }}</td>
            <td rowspan="3">{{ $student->class->class_name }}</td>
            <td rowspan="3">{{ $student->student->name }}</td>
            <td>{{ $student->roll_number }}</td>
            <td>{{$RegistrationFee}}</td>
        </tr>

        <tr>
            <td>Discount({{$discountParcent}}%)</td>
            <td>{{$parentAmount}}</td>
        </tr>
        <tr>
            <td>Total Fee</td>
            <td>Tk. {{ $finalAmount }}</td>
        </tr>




    </table>
</div>
</body>
</html>


