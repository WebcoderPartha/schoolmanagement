
<!DOCTYPE html>
<html>
<head>
    <title>Employee ID Card</title>
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
        body{display: none}
        .main_container{
            width: 400px;
            margin: 40px auto;
            max-width: 50%;
            height: 368px;
        }
        .header, .footer {
            background-color: #04AA6D;
            color: #fff;
            text-align: center;
            padding: 20px 0px;
        }
        .header h2, .footer h2 {
            margin: 0;
            padding: 0px;
        }
        .header p, .footer p {
            margin: 0;
            font-size: 24px;
            margin-top: 5px;
        }

    </style>
</head>
<body>
<div class="main_container">
    <div class="header">
        <h2>Employee ID: {{ $employee->id_number }}</h2>
    </div>

    <table id="customers">

        <tr>
{{--            <td colspan="4" align="center"><img width="250" src="{{ asset($employee->image) }}" alt=""></td>--}}
            <td colspan="4" align="center"><img width="250" src="data:image/jpg;base64,{{ $image }}" alt=""></td>
        </tr>

        <tr>
            <td colspan="2">Name:</td>
            <td colspan="2"><b>{{ $employee->name }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Father Name:</td>
            <td colspan="2"><b>{{ $employee->father_name }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Designation:</td>
            <td colspan="2"><b>{{ $employee->designation->name }}</b></td>
        </tr>

        <tr>
            <td colspan="2">Joining Date:</td>
            <td colspan="2"><b>{{ $employee->joining_date }}</b></td>
        </tr>


    </table>
    <div class="footer">
        <h2></h2>
    </div>

</div>
</body>
</html>


