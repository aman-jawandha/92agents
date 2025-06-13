@extends('admin.master')
@section('title', 'dashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/summernote/css/summernote.css') }}">
    <style>
        .note-btn-group .btn {
            color: #000 !important;
        }

        .btn-group {
            display: inline-table;
        }
    </style>
@stop
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add Pop-in
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('admin.popins') }}">Pop-ins List</a></li>
                <li class="active">Add Pop-in</li>
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
                            <form method="POST" action="{{ route('admin.store-popin') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-4">
                                    <label>Button Text</label>
                                    <input type="text" name="title" class="form-control" maxlength="50"
                                        placeholder="Eg. Explore Blog, Agent Post etc." required>
                                </div>
                                <div class="col-md-8">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" maxlength="250"
                                        placeholder="Heading" required>
                                </div>
                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control" maxlength="5000" name="description"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Image</label>
                                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/*"
                                        class="form-control" placeholder="Image">
                                </div>
                                <div class="col-md-6">
                                    <label>Url</label>
                                    <input type="url" name="url" class="form-control" maxlength="250"
                                        placeholder="Add url to show button">
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-3">
                                    <label>Whom To Show?</label>
                                    <select class="form-control" name="for_whom" required>
                                        <option value="" disabled selected>Select User</option>
                                        <option value="3">Seller</option>
                                        <option value="2">Buyer</option>
                                        <option value="4">Agent</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option selected value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Backgroud Color</label>
                                    <input type="color" name="bg_color" value="#37A000" class="form-control"
                                        placeholder="Background Color" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Button Color</label>
                                        <input type="color" name="btn_color" value="#121211" class="form-control"
                                        placeholder="Button Color" required>
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">
                                    <label>Choose Pop-in Design</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top_right" name="design" id="top_right">
                                        <label class="form-check-label" for="top_right">Top-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="right" name="design" id="right" checked>
                                        <label class="form-check-label" for="right">Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom_right" name="design" id="bottom_right">
                                        <label class="form-check-label" for="bottom_right">Bottom-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom" name="design" id="bottom">
                                        <label class="form-check-label" for="bottom">Bottom</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top_left" name="design" id="top_left">
                                        <label class="form-check-label" for="top_left">Top-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom_left" name="design" id="bottom_left">
                                        <label class="form-check-label" for="bottom_left">Bottom-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="left" name="design" id="left">
                                        <label class="form-check-label" for="left">Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top" name="design" id="top">
                                        <label class="form-check-label" for="top">Top</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="full_screen" name="design" id="full_screen">
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
@section('scripts')
    <script src="{{ URL::asset('assets/plugins/summernote/js/summernote.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#summernote').summernote();
    </script>
@stop
