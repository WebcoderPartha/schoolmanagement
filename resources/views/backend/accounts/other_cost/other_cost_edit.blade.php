@extends('layout.admin_master')
@section('title')
    Edit Other Cost
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">

            <div class="col-sm-6 mx-auto grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Edit Other Cost <a href="{{ route('accounts.other_cost_view') }}" class="btn float-right btn-sm btn-info">Back</a></h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('accounts.other_cost_update', $otherCost->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="student_year">Date</label>
                                        <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime($otherCost->date)) }}" name="date" id="date">

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
                                        <textarea class="form-control" name="description" placeholder="Type other cost description" id="description">{{ $otherCost->description }}</textarea>
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
                                        <input value="{{ $otherCost->amount }}" type="text" class="form-control" placeholder="Enter amount" name="amount" id="amount">
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
                                        Update Other Cost
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

