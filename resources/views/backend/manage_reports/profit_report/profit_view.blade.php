@extends('layout.admin_master')
@section('title')
    Profit Report
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Profit Report</h4>
            </div>
            <div class="card-body">
                <form action="{{route('reports.profit_search')}}" method="GET">
                    <div class="row search">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" value="{{ (!empty($_GET['start_date']))? date('Y-m-d') : '' }}" class="form-control" name="start_date" id="start_date">
                                @error('start_date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control"  value="{{ (!empty($_GET['end_date']))? date('Y-m-d') : '' }}" name="end_date" id="end_date">
                                @error('end_date')
                                <small class="text-danger">
                                    <i>{{ $message }}</i>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2"><button type="submit" class="btn btn-primary" style="margin-top:30px">Search</button></div>
                    </div>
                </form>
            </div>
        </div>


        @if(isset($studentFee))
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profit Report</h4>
                            <div class="table-respnsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Student Total Fee</th>
                                        <th>Employee Total Salary</th>
                                        <th>Total Other Cost</th>
                                        <th>Total Expense</th>
                                        <th>Profit</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>{{ number_format($studentFee, 0) }}</td>
                                        <td>{{ number_format($AccountSalary, 0) }}</td>
                                        <td>{{ number_format($otherCost, 0) }}</td>
                                        <td>{{ number_format($totalCost,0) }}</td>
                                        <td><b>{{ number_format($profit, 0) }}</b></td>
                                        <td>
                                            <a target="_blank" href="{{ route('reports.profit_pdf', ['start_date'=>$_GET['start_date'], 'end_date' => $_GET['end_date']]) }}" class="btn btn-sm btn-primary btn-icon-text"><i class="typcn typcn-printer btn-icon-append"></i>
                                            </a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
            @endif
    </div>

@endsection

