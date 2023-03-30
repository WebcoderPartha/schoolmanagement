<!DOCTYPE html>
<html>
<head>
    <title>Print PDF</title>
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
<h2 style="text-align: center">Class Wise Subject List</h2>
<hr>

@foreach($allData as $classes)
<h3 style="text-align: center"><b>{{ $classes[0]->class->class_name }}</b></h3>

<table id="customers">
    <tr>
        <th>SL</th>
        <th>Subject Name</th>
        <th>Full Mark</th>
        <th>Pass Mark</th>
        <th>Subjective Mark</th>
    </tr>


        @foreach($classes as $key => $subject)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $subject->subject->name }}</td>
                <td>{{ $subject->full_mark }}</td>
                <td>{{ $subject->pass_mark }}</td>
                <td>{{ $subject->subjective_mark }}</td>
            </tr>
        @endforeach
</table>
@endforeach
</body>
</html>


