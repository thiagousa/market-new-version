@extends('admin.sidebar-template')

@section('title', 'Edit Products | ')

@section('head')
@parent
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-select/bootstrap-select.min.css') }}">
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
                    Products <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('products') }}" class="text-primary" title="Products">Products</a></li>
                    <li>{{ $product->shortName }}</li>
                    <li>Edit</li>
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
                        <button type="button" class="btn-back" data-url="{{ route('products') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Edit</h3>
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
                        'id' => 'products',
                        'method' => 'put',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('productsEditPut')
                        ])
                    !!}
                    {!! Form::hidden('productsId', $product->productsId) !!}

                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('shortName', 'Short Name *') !!}
                                {!! Form::text('shortName', $product->shortName, ['class'=>'form-control', 'id'=>'shortName', 'maxlength'=>50]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('code', 'Code *') !!}
                                {!! Form::text('code', $product->code, ['class'=>'form-control', 'id'=>'code', 'maxlength'=>35]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('description', 'Description *') !!}
                                {!! Form::text('description', $product->description, ['class'=>'form-control', 'id'=>'description', 'maxlength'=>120]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('code', 'Quantity *') !!}
                                {!! Form::text('code', $product->quantity, ['class'=>'form-control', 'id'=>'code', 'maxlength'=>35 ,'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('name', 'Brand *') !!}
                                {!! Form::text('brand', $product->brand, ['class'=>'form-control', 'id'=>'brand', 'maxlength'=>50]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('categoriesId', 'Category') !!}
                                {!! Form::select('categoriesId', $categories, $product->categoriesId, ['id' => 'categoriesId', 'data-taxes' => $categoriesTax, 'class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('costPrice', 'Cost Price *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('costPrice', $product->costPrice, ['class'=>'form-control', 'id'=>'costPrice', 'maxlength'=>8]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('salePrice', 'Sale Price *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('salePrice', $product->salePrice, ['class'=>'form-control', 'id'=>'salePrice', 'maxlength'=>8]) !!}
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">--}}
                        {{--<div class="form-input">--}}
                        {{--{!! Form::label('quantity', 'Quantity') !!}--}}
                        {{--{!! Form::text('quantity', '', ['class'=>'form-control', 'id'=>'quantity', 'maxlength'=>25, 'disabled'=>true]) !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-lg-4 col-md-10 col-sm-9 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('tax', 'Tax') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    {!! Form::text('tax', $product->tax, ['class'=>'form-control', 'id'=>'tax', 'maxlength'=>5, 'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('codeBalance', 'Balance Code *') !!}
                                {!! Form::text('codeBalance', $product->codeBalance, ['class'=>'form-control', 'id'=>'codeBalance', 'maxlength'=>12]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('codeBegin', 'Code Begin') !!}
                                {!! Form::text('codeBegin', $product->codeBegin, ['class'=>'form-control', 'id'=>'codeBegin', 'maxlength'=>2]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('codeEnd', 'Code End') !!}
                                {!! Form::text('codeEnd', $product->codeEnd, ['class'=>'form-control', 'id'=>'codeEnd', 'maxlength'=>2]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('priceBegin', 'Price Begin') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('priceBegin', $product->priceBegin, ['class'=>'form-control', 'id'=>'priceBegin', 'maxlength'=>2]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('priceEnd', 'Price End') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('priceEnd', $product->priceEnd, ['class'=>'form-control', 'id'=>'priceEnd', 'maxlength'=>2]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('min', 'Minimum Balance *') !!}
                                {!! Form::text('min', $product->min, ['class'=>'form-control', 'id'=>'min', 'maxlength'=>10]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('max', 'Maximum Balance *') !!}
                                {!! Form::text('max', $product->max, ['class'=>'form-control', 'id'=>'max', 'maxlength'=>10]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountMoney', 'Maximum Money *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('discountMoney', $product->discountMoney, ['class'=>'form-control', 'id'=>'discountMoney', 'maxlength'=>6]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discount', 'Maximum discount *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    {!! Form::text('discount', $product->discount, ['class'=>'form-control', 'id'=>'discount', 'maxlength'=>5]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 push-30-t">
                            {!! Form::submit('Save', ['class'=>'btn btn-primary pull-left']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
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
<script src="{{ asset('assets/js/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
{{-- Add MASK MONEY plugin --}}
<script src="{{ asset('assets/js/jquery.maskmoney.js') }}"></script>
<script type="text/javascript">
$(function(){
    // Apply mask money funtion to input
    $('#costPrice').maskMoney();
    $('#salePrice').maskMoney();
    $('#discountMoney').maskMoney();
    $('#discount').maskMoney();

    // Get taxes through category field and fill the tax input
    $('#categoriesId').change(function () {
        var id = $(this).val();
        var taxes = $(this).data('taxes');
        if(id) {
            $('#tax').val(taxes[id]);
        }else{
            $('#tax').val('');
        }
    });

    // FRONT END VALIDATION
    $('.form-horizontal').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group .form-input').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-input').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        success: function(e) {
            jQuery(e).closest('.form-input').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        ignore: [],
        rules: {
            'description': {
                required: true
            },
            'shortName': {
                required: true,
            },
            'code': {
                required: true,
                digits: true
            },
            'costPrice': {
                required: true,
            },
            'salePrice': {
                required: true
            },
            'min': {
                required: true,
                digits: true
            },
            'max': {
                required: true,
                digits: true
            },
            'discountMoney': {
                required: true
            },
            'discount': {
                required: true
            }
        }
    });
});
</script>
@stop
