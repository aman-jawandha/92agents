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
                Update Pop-in
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('admin.popins') }}">Pop-ins List</a></li>
                <li class="active">Update Pop-in</li>
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
                            <form method="POST" id="popin_form" action="{{ route('admin.update-popin') }}" enctype="multipart/form-data">
                                <input type="hidden" name="popin_id" value="{{$popin->id}}">
                                @csrf
                                <div class="col-md-4">
                                    <label>Button Text</label>
                                    <input type="text" name="title" value="{{$popin->title}}" class="form-control" maxlength="50"
                                        placeholder="Eg. Explore Blog, Agent Post etc." required>
                                </div>
                                <div class="col-md-8">
                                    <label>Heading</label>
                                    <input type="text" name="heading" value="{{$popin->heading}}" class="form-control" maxlength="250"
                                        placeholder="Heading">
                                </div>
                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control" maxlength="5000" name="description">{{$popin->description}}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <label>Previous Image</label>
                                    <div>
                                        @if($popin->image)
                                        <a href="{{ asset('uploads/popin_images/'.$popin->image)}}" target="_blank"><img src="{{ asset('uploads/popin_images/'.$popin->image)}}" width="100px" height="100px" alt="Popin Image"></a>
                                        @else
                                        <p class="m-0">No Image Seleted</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Change Image</label>
                                    <input type="file" name="image" id="fileInput" class="form-control" placeholder="Image">
                                <span id="error-msg" style="color: red;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Url</label>
                                    <input type="url" name="url" class="form-control" maxlength="250"
                                        value="{{$popin->url}}" placeholder="Add url to show button">
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-3">
                                    <label>Whom To Show?</label>
                                    <select class="form-control" name="for_whom" required>
                                        <option {{($popin->for_whom == '3') ? 'selected' : ''}} value="3">Seller</option>
                                        <option {{($popin->for_whom == '2') ? 'selected' : ''}} value="2">Buyer</option>
                                        <option {{($popin->for_whom == '4') ? 'selected' : ''}} value="4">Agent</option>
                                        <option {{($popin->for_whom == 'All') ? 'selected' : ''}} value="All">All</option>
                                    </select>
                                </div>
                                @if($popin->status != 'Most Liked')
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option {{($popin->status == 'Active') ? 'selected' : ''}} value="Active">Active</option>
                                        <option {{($popin->status == 'Inactive') ? 'selected' : ''}} value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                @else
                                <input type="hidden" name="status" value="Most Liked">
                                @endif
                                <div class="col-md-3">
                                    <label>Backgroud Color</label>
                                    <input type="color" name="bg_color" value="{{$popin->bg_color}}" class="form-control"
                                        placeholder="Background Color" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Button Color</label>
                                        <input type="color" name="btn_color" value="{{$popin->btn_color}}" class="form-control"
                                        placeholder="Button Color" required>
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">
                                    <label>Choose Pop-in Design</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top_right" name="design"
                                            id="top_right" {{ ($popin->design == 'top_right') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="top_right">Top-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="right" name="design"
                                            id="right" {{ ($popin->design == 'right') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="right">Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom_right" name="design"
                                            id="bottom_right" {{ ($popin->design == 'bottom_right') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bottom_right">Bottom-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom" name="design"
                                            id="bottom" {{ ($popin->design == 'bottom') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bottom">Bottom</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top_left" name="design"
                                            id="top_left" {{ ($popin->design == 'top_left') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="top_left">Top-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom_left" name="design"
                                            id="bottom_left" {{ ($popin->design == 'bottom_left') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bottom_left">Bottom-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="left" name="design"
                                            id="left" {{ ($popin->design == 'left') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="left">Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top" name="design"
                                            id="top" {{ ($popin->design == 'top') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="top">Top (Full Width)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="full_screen" name="design"
                                            id="full_screen" {{ ($popin->design == 'full_screen') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="full_screen">Full-Screen</label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-u btn-u-success">Update</button>
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

let isFileValid = true;

function validateFileInput() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    const errorMsg = document.getElementById('error-msg');
    errorMsg.textContent = '';
    isFileValid = true;

    if (!file) {
        return;
    }

    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    const maxSize = 1 * 1024 * 1024;

    if (!allowedTypes.includes(file.type)) {
        errorMsg.textContent = 'Allowed file types are jpg, jpeg, png and webp.';
        isFileValid = false;
        return;
    }

    if (file.size > maxSize) {
        errorMsg.textContent = 'Image must be less than 1MB.';
        isFileValid = false;
        return;
    }
}

document.getElementById('fileInput').addEventListener('change', function () {
    validateFileInput();
});

document.getElementById('popin_form').addEventListener('submit', function (e) {
    validateFileInput();
    if (!isFileValid) {
        e.preventDefault();
    }
});
    </script>
@stop
