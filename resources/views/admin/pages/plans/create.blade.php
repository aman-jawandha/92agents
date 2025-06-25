@extends('admin.master')
@section('title', 'dashboard')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add Plan
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('plans-index') }}">Plans List</a></li>
                <li class="active">Add Plan</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content profile">

            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error')) 
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('store-plan') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label>Plan Title</label>
                                    <input type="text" name="title" class="form-control" maxlength="50"
                                        placeholder="Eg. Golden Plan, Premium Plan" value="{{old('title')}}" required>
                                </div>
                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea class="form-control" maxlength="5000" name="description">{{old('description')}}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label>Price (in $)</label>
                                    <input step="0.01" value="{{old('price')}}" type="number" name="price" class="form-control" min="1" max="1000" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Duration (in months)</label>
                                    <input type="number" name="duration" value="{{old('duration')}}" class="form-control" min="1" max="12" required>
                                </div>
                                <div class="col-md-3">
                                    <label>No. Of Popins Allowed</label>
                                    <input type="number" name="no_of_popins" value="{{old('no_of_popins')}}" class="form-control" min="1" max="100" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option selected value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label>Choose Designs For This Plan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="top_right" id="top_right">
                                        <label class="form-check-label" for="top_right">Top-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="right" id="right">
                                        <label class="form-check-label" for="right">Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="bottom_right" id="bottom_right">
                                        <label class="form-check-label" for="bottom_right">Bottom-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="bottom" id="bottom">
                                        <label class="form-check-label" for="bottom">Bottom</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="top_left" id="top_left">
                                        <label class="form-check-label" for="top_left">Top-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="bottom_left" id="bottom_left">
                                        <label class="form-check-label" for="bottom_left">Bottom-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="left" id="left">
                                        <label class="form-check-label" for="left">Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="top" id="top">
                                        <label class="form-check-label" for="top">Top</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="designs[]" type="checkbox"  value="full_screen" id="full_screen">
                                        <label class="form-check-label" for="full_screen">Full-Screen</label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-u btn-u-success">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
@endsection
