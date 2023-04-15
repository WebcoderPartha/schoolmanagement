@extends('layout.admin_master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column">
                <h5 class="mb-2 text-titlecase mb-4">Dashboard</h5>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="mb-0 text-muted">Total Employee</p>
                                    <p class="mb-0 text-muted"></p>
                                </div>
                                <h4>
                                    @php
                                    $employee = \App\Models\Employee::count();
echo $employee;
                                            @endphp
                                </h4>
                                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="mb-0 text-muted">Total Student</p>
                                    <p class="mb-0 text-muted"></p>
                                </div>
                                <h4>
                                    @php
                                        $students = \App\Models\Student::count();
    echo $students;
                                    @endphp
                                </h4>
                                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 grid-margin stretch-card flex-column">
                <h5 class="mb-2 text-titlecase mb-4">Expense Report</h5>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="mb-0 text-muted">This Month Total Student Fees</p>
                                    <p class="mb-0 text-muted"></p>
                                </div>
                                <h4>
                                    @php
                                        $studentFees = \App\Models\AccountStudentFee::where('date', date('m-Y'))->sum('amount');
    echo $studentFees;
                                    @endphp
                                 BDT</h4>
                                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="mb-0 text-muted">This Month Total Employee Salary </p>
                                    <p class="mb-0 text-muted"></p>
                                </div>
                                <h4>
                                    @php
                                        $salary = \App\Models\AccountEmployeeSalary::where('date', date('F, Y'))->sum('amount');
    echo number_format($salary, 0);
                                    @endphp
                                    BDT
                                </h4>
                                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-100">
                    <div class="col-md-6 stretch-card grid-margin grid-margin-md-0">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="text-muted">This Month Other Cost</p>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4>
                                        @php
                                            $otherCost = \App\Models\AccountOtherCost::where('date','LIKE', '%'.date('m-Y').'%')->sum('amount');
        echo number_format($otherCost, 0);
                                        @endphp
                                        BDT
                                    </h4>
                                </div>
                                <canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card">
                        <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="text-muted">This Month Profit</p>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4>
                                        @php
                                            $expense = $otherCost + $salary;
                                            $profit = $studentFees - $expense;
                                            echo number_format($profit, 0)
                                        @endphp
                                        BDT
                                    </h4>
                                </div>
                                <canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>





    </div>

@endsection
