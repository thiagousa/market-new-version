
@extends('admin.sidebar-template')

@section('title', 'Orders | ')

@section('head')
@parent
<!-- Page JS Plugins CSS -->
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Orders <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Orders</li>
                    <li>List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">
                    {!! Form::button('<i class="fa fa-plus"></i> Add New', ['class'=>'btn btn-primary', 'onclick'=>'window.open(\''.route('ordersAdd').'\', \'_self\');']) !!}
                </h3>
            </div>
            <div class="block-content">
                @if (Session::has('success'))
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {!! Session::get('success') !!}
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->

                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th style="width: 50px;">Id</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center sorting-none" style="width: 50px;">View</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                            <tr>
                            <td>{{ $order->ordersId }}</td>
                            <td class="font-w600">{{ $order->updated_at->format('m/d/Y') }}</td>
                            <td class="font-w600">{{ $order->promoter->name }}</td>
                            <td class="font-w600">{{ $order->finalValue }}</td>
                            <td class="font-w600">{{ $order->status }}</td>
                            <td class="text-center">
                                {!! Form::button('<i class="fa fa-file"></i> ', ['title'=>'View', 'data-toggle'=>'tooltip', 'class'=>'btn btn-xs btn btn-info',
                                    'onclick'=>'window.open(\''.route('ordersView', $order->ordersId).'\', \'_self\')']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@section('javascript')
@parent
<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('assets/js/pages/base_tables_datatables.js') }}"></script>
<!-- Personalizing dataTable -->
<script>
jQuery(function(){
    jQuery('.js-dataTable-full').dataTable({
        order: [[1, 'asc']],
        columnDefs: [ { orderable: false, targets: 'sorting-none' } ],
        pageLength: 10,
        lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
        language: {
            'url': '<?php echo asset('assets/json/dataTablesEN-US.json'); ?>'
        }
    });
});
</script>
@stop