@extends('dashboard.master')
@section('title', 'Blog List')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/summernote/css/summernote.css') }}">
@stop

@section('content')
<?php $topmenu = 'Home'; ?>
<?php $activemenu = 'Blog'; ?>
@include('dashboard.include.sidebar')

<div class="container content profile">
    <div class="row">
        @include('dashboard.user.buyers.include.sidebar')
        @include('dashboard.user.buyers.include.sidebar-dashbord')

        <div class="col-md-9">
            <h1 class="margin-bottom-40">Your Blog List</h1>
            <div class="box-shadow-profile homedata homedataposts">
                <div class="panel-profile">
                    <div class="panel-heading overflow-h air-card">
                        <h2 class="panel-title heading-sm pull-left"><i class="fa fa-newspaper-o"></i>Blogs.</h2>
                        <span class="btn btn-success float-right" data-toggle="modal" data-target="#addblog">Add Blog</span>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Blog Title</th>
                                    <th>Category</th>
                                    <th>Added Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->cat_name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($blog->created_date)) }}</td>
                                        <td>
                                            <a target="_blank" href="{{ url('/blogs') }}/{{ $blog->id }}/{{ $blog->title }}" class="btn btn-success"><i class="fa fa-eye" style="color: #fff !important;"></i></a>
                                            <button class="btn btn-primary edit-post-js" data-id="{{ $blog->id }}"><i class="fa fa-edit" style="color: #fff;"></i></button>
                                            <button class="btn btn-danger" id="{{ $blog->id }}" onclick="delblog(this.id)"><i class="fa fa-trash" style="color: #fff;"></i></button>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Blog Modal -->
<div class="modal fade" id="addblog" tabindex="-1" role="dialog" aria-labelledby="addBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content not-top">
            <div class="modal-header">
                <h4>Add Blog</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('blog.addblog') }}" class="form-horizontal" role="form" enctype="multipart/form-data" id="popin_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" name="title" maxlength="250" class="form-control text-uppercase" placeholder="Blog Title" required>
                        </div>
                        <div class="col-md-6">
                            <label>Select Category</label>
                            <select name="cat_id" class="form-control" required>
                                <option value="">--------------------</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" id="fileInput" class="form-control" placeholder="Image">
                            <span id="error-msg" style="color: red;"></span>
                        </div>
                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea id="summernote" class="form-control" maxlength="5000" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top: 15px;">
                        <button class="btn-u btn-u-success">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer foote-nb"></div>
        </div>
    </div>
</div>

<!-- Edit Blog Modal -->
<div class="modal fade" id="editBlog" tabindex="-1" role="dialog" aria-labelledby="editBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content not-top">
            <div class="modal-header">
                <h4>Update Blog</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('blog.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" id="editBlogForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" id="blog_title" name="title" maxlength="250" class="form-control text-uppercase" placeholder="Blog Title" required>
                        </div>
                        <div class="col-md-6">
                            <label>Select Category</label>
                            <select id="blog_cat_id" name="cat_id" class="form-control" required>
                                <option value="">--------------------</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" id="fileInputEdit" class="form-control" placeholder="Image">
                            <span id="error-msg-edit" style="color: red;"></span>
                        </div>
                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea id="summernote2" maxlength="5000" class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top: 15px;">
                        <input type="hidden" name="id" id="blog_id">
                        <button class="btn-u btn-u-success">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer foote-nb"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/plugins/summernote/js/summernote.min.js') }}"></script>

<script>
    $('#summernote').summernote();
    $('#summernote2').summernote();

    $(document).on('click', '.edit-post-js', function() {
        let post_id = $(this).data("id");
        $.ajax({
            url: '{{ url('/buyer/get/blog/') }}/' + post_id,
            type: 'GET',
            success: function(data) {
                try {
                    let res = JSON.parse(data);
                    $("#blog_id").val(res.id);
                    $("#blog_title").val(res.title);
                    $("#blog_cat_id").val(res.cat_id);
                    $("#summernote2").summernote("code", res.description);
                    $("#editBlog").modal("show");
                } catch {
                    alert('Blog not found');
                }
            },
            error: function() {
                alert('Blog not found');
            }
        });
    });

    $("#editBlogForm").submit(function(e) {
        e.preventDefault();
        validateFileInput('fileInputEdit', 'error-msg-edit');
        if (!isFileValid) return;
        let this_form = $(this);
        $.ajax({
            url: this_form.attr("action"),
            type: 'POST',
            data: new FormData(this_form[0]),
            contentType: false,
            processData: false,
            success: function(data) {
                if (data) {
                    alert('Blog updated successfully');
                    setTimeout(() => window.location.reload(), 1500);
                }
            }
        });
    });

    function delblog(id) {
        if (confirm("Are you sure?")) {
            $.ajax({
                url: '{{ url('/buyer/blog/') }}/' + id,
                type: 'GET',
                success: function() {
                    alert('Blog deleted successfully');
                    window.location.reload();
                }
            });
        }
    }

    // File Validation
    let isFileValid = true;

    function validateFileInput(inputId, errorId) {
        const fileInput = document.getElementById(inputId);
        const file = fileInput?.files[0];
        const errorMsg = document.getElementById(errorId);
        errorMsg.textContent = '';
        isFileValid = true;

        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        const maxSize = 1 * 1024 * 1024;

        if (!allowedTypes.includes(file.type)) {
            errorMsg.textContent = 'Allowed file types are jpg, jpeg, png and webp.';
            isFileValid = false;
        } else if (file.size > maxSize) {
            errorMsg.textContent = 'Image must be less than 1MB.';
            isFileValid = false;
        }
    }

    document.getElementById('fileInput')?.addEventListener('change', () => {
        validateFileInput('fileInput', 'error-msg');
    });

    document.getElementById('fileInputEdit')?.addEventListener('change', () => {
        validateFileInput('fileInputEdit', 'error-msg-edit');
    });

    document.getElementById('popin_form')?.addEventListener('submit', function(e) {
        validateFileInput('fileInput', 'error-msg');
        if (!isFileValid) e.preventDefault();
    });
</script>
@stop
