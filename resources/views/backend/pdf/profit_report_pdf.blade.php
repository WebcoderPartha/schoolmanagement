<!DOCTYPE html>
<html>
<head>
    <title>Monthly Profit Report</title>
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
        <h2>SCHOOL MANAGEMENT SYSTEM</h2>
        <p>Monthly Profit Report</p>
        <p>{{ $date  }}</p>
    </div>

    <table id="customers" style="text-align: center !important;">


        <tr>
            <th>Total Student Fee</th>
            <th>Total Employee Salary</th>
            <th>Total Other Cost</th>
            <th>Expense</th>
            <th>Profit</th>
        </tr>

        <tr>


            <td rowspan="4" height="100">{{ number_format($studentFee, 0) }}</td>
            <td rowspan="4">{{ number_format($AccountSalary, 0) }}</td>
            <td rowspan="4">{{ number_format($otherCost, 0) }}</td>
            <td rowspan="4">{{ number_format($totalCost, 0) }}</td>
            <td rowspan="5">{{ number_format($profit, 0)  }} TK</td>
{{--            <td rowspan="5">{{ number_format($thisMonthSalary, 0) }} Tk</td>--}}
        </tr>
        <tr>

        </tr>
        <tr>

        </tr>
        <tr>

        </tr>
        <tr>

            <td colspan="4" style="text-align: right">Total:</td>

        </tr>












    </table>
    <div class="header">

        <p>Auto generated. No need any signature.</p>

    </div>
</div>

</body>
</html>


