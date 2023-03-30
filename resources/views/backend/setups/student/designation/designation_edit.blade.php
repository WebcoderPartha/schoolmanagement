@extends('layout.admin_master')
@section('title')
    Edit Designation
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">


            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Designation</h4>
                        <form class="forms-sample" method="POST" action="{{ route('designation.update', $designation->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Designation Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $designation->name }}" name="name" id="name" placeholder="Student fee category">
                                    @error('name')
                                    <small class="text-danger">
                                        <i>{{ $message }}</i>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

