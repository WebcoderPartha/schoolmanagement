@extends('layout.admin_master')
@section('title')
    Other Cost
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-sm-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Other Cost</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="otherCostData">
                                @foreach($otherCosts as $key => $otherCost)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ date('d F, Y', strtotime($otherCost->date)) }}</td>
                                        <td>{{ $otherCost->description }}</td>
                                        <td>{{ $otherCost->amount }}</td>
                                        <td>
                                            <a href="{{ route('accounts.other_cost_edit', $otherCost->id) }}" class="btn btn-sm btn-warning btn-icon-text"> <i class="typcn typcn-edit btn-icon-prepend"></i></a>
                                            <a id="delete" href="{{ route('accounts.other_cost_delete', $otherCost->id) }}" class="btn btn-sm btn-danger btn-icon-text"> <i class="typcn typcn-trash btn-icon-prepend"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Other Cost</h4>
                        <form action="{{ route('accounts.other_cost_store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="student_year">Date</label>
                                        <input type="date" class="form-control" name="date" id="date">

                                        @error('date')
                                        <small class="text-danger">
                                            <i>{{ $message }}</i>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" placeholder="Type other cost description" id="description"></textarea>
                                        @error('description')
                                        <small class="text-danger">
                                            <i>{{ $message }}</i>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" placeholder="Enter amount" name="amount" id="amount">
                                        @error('amount')
                                        <small class="text-danger">
                                            <i>{{ $message }}</i>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <button id="submit" class="btn btn-primary">
                                        Add Other Cost
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

