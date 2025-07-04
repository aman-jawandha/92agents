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
                Plans
                <small>Plans list</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('plans-index') }}">Plans</a></li>
                <li class="active">Plans list</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-right">
                            <h3 class="box-title"><a class="btn btn-success" href="{{ route('create-plan') }}">
                                    <i class="fa fa-plus fa-xs"></i> Add Plan</a>
                            </h3>
                        </div>
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
                                        <th>Sr.No</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Provided Designs</th>
                                        <th>No. Of Popins</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $key => $plan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $plan->title }}</td>
                                            <td>${{ $plan->price }}</td>
                                            <td>{{ $plan->duration}} months</td>
                                            <td>{{ $plan->designs}}</td>
                                            <td>{{ $plan->no_of_popins}}</td>
                                            <td>
                                                <span class="badge badge-success" style="background-color:{{($plan->status == 'Active') ? '#00a65a' : '#dd4b39'}}">{{ $plan->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-plan', $plan->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                {{-- <form id="delete-form" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('delete-plan', $plan->id) }}', 'Plan')"><i
                                                        class="fa fa-trash"></i></button> --}}
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
