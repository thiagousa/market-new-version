@extends('admin.sidebar-template')

@section('title', 'Add Order | ')

@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
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
                    <li><a href="{{ route('orders') }}" class="text-primary" title="Orders">Orders</a></li>
                    <li>Add</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-gray-darker text-white">
                <ul class="block-options">
                    <li>
                        <button type="button" class="btn-back" data-url="{{ route('orders') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Add</h3>
            </div>
            <div class="block-content">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- .block-content -->
                <div class="block-content block-content-full">
                    {!! Form::open([
                            'id' => 'orders',
                            'method' => 'post',
                            'class' => 'form-horizontal push-20-t',
                            'url' => route('ordersAdd')
                        ])
                    !!}
                    <div class="form-group">
                        <div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('created_at', 'Date') !!}
                                {!! Form::text('created_at', '', ['class'=>'js-datepicker js-masked-date form-control', 'data-date-format' => 'dd/mm/yyyy', 'placeholder' => 'dd/mm/yyyy', 'id'=>'created_at', 'maxlength'=>10]) !!}
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-7 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('promotersName', 'Promoter') !!}
                                {!! Form::select('promotersId', $promoters, '', ['id' => 'promotersId', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <br>
                    <h4>Products List</h4>
                    <hr>
                    <div id="products-list">
                        <div class="form-group">
                            <div class="col-lg-5 col-md-3 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('Description', 'Description ') !!}
                                    {!! Form::select('productsId', $products, '', ['id' => 'productsId', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('quantity', 'Quantity ') !!}
                                    {!! Form::number('quantity', '0', ['class'=>'form-control', 'id'=>'quantity', 'maxlength'=>5]) !!}
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('unitPrice', 'Cost Unit Price') !!}
                                    {!! Form::text('unitPrice', '0.00', ['class'=>'form-control', 'id'=>'unitPrice', 'maxlength'=>5]) !!}
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('totalPrice ', 'Total ') !!}
                                    {!! Form::text('totalPrice', '0.00', ['class'=>'form-control', 'id'=>'totalPrice', 'maxlength'=>5,'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <a href="#" class="btn btn-primary btn-xs pull-right"><span class="fa fa-plus"></span> Add more</a>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('finalValue', 'Final Value') !!}
                                {!! Form::text('finalValue', '0.00', ['class'=>'form-control', 'id'=>'finalValue', 'maxlength'=>5, 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('status', 'Status') !!}
                                {!! Form::select('status', $status, '', ['id' => 'status', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 push-30-t text-right">
                            {!! Form::submit('Back', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
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
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
<script type="application/javascript">
$(function () {
    //START VALIDATE FORM CODE
    $('.form-horizontal').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function (error, e) {
            jQuery(e).parents('.form-group .form-input').append(error);
        },
        highlight: function (e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        success: function (e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        ignore: [],
        rules: {
            'created_at': {
                required: true
            },
            'promoter': {
                required: true
            }
        }
    });
    // Init page helpers (BS Datepicker + Masked Input)
    App.initHelpers(['datepicker', 'masked-inputs']);
});
</script>
@stop