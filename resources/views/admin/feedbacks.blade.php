@extends('admin.master')
@section('title', 'dashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet"
        type="text/css" />
    <style>
        .modal-content {
            border-radius: 10px !important;
        }
    </style>
@stop
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Feedbacks
                <small>Feedbacks list</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('feedbacks') }}">Feedbacks</a></li>
                <li class="active">Feedbacks list</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="DataList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="max-width: 50px">Sr.No</th>
                                        <th style="max-width: 200px">Email</th>
                                        <th>Feedback</th>
                                        <th style="max-width: 50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $key => $feedback)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $feedback->email }}</td>
                                            <td>
                                                <div class="accordion" id="accordion_{{ $key }}">
                                                    <div class="card">
                                                        <div class="card-header" id="heading_{{ $key }}">
                                                                <button class="btn btn-success" type="button"
                                                                    data-toggle="collapse"
                                                                    data-target="#collapse_{{ $key }}"
                                                                    aria-expanded="true"
                                                                    aria-controls="collapse_{{ $key }}">
                                                                    View Message
                                                                </button>
                                                        </div>
                                                        <div id="collapse_{{ $key }}" class="collapse"
                                                            aria-labelledby="heading_{{ $key }}"
                                                            data-parent="#accordion_{{ $key }}">
                                                            <div class="card-body">
                                                                {!! nl2br(e($feedback->message)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form id="delete-form" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('delete-feedback', $feedback->id) }}', 'Feedback')"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script type="text/javascript" src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>
    <script type="text/javascript">
        var table1 = $('#DataList').DataTable({
            "ordering": false,
        });

        function confirmDelete(url, msg) {
            BootstrapDialog.show({
                title: '<p style="color:white;" class="text-center">Delete Confirmation</p>',
                message: `Are you sure you want to delete this ${msg}?`,
                size: BootstrapDialog.SIZE_SMALL,
                buttons: [{
                        label: 'Ok',
                        cssClass: 'btn-primary',
                        action: function(dialogItself) {
                            dialogItself.close();
                            let form = document.getElementById('delete-form');
                            form.action = url;
                            form.submit();
                        }
                    },
                    {
                        label: 'Close',
                        cssClass: 'btn-secondary',
                        action: function(dialogItself) {
                            dialogItself.close();
                        }
                    }
                ]
            });
        }
    </script>
@stop
