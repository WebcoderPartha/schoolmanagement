<!DOCTYPE html>
<html>
<head>
    <titl>Print PDF</titl>
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
    </style>
</head>
<body>

<h1 style="text-align: center">STUDENT MANAGEMENT SYSTEM</h1>
<h3 style="text-align: center"><b>{{ $amounts[0]->fee_category->name }}</b></h3>

<table id="customers">
    <tr>
        <th>SL</th>
        <th>Class</th>
        <th>Amount</th>
    </tr>
    @if(count($amounts))

        @foreach($amounts as $key => $amount)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $amount->student_class->class_name }}</td>
                <td>{{ $amount->amount }}</td>
            </tr>
        @endforeach
    @endif
</table>

</body>
</html>


