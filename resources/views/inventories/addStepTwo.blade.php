
@extends('admin.sidebar-template')

@section('title', 'Add Inventory ('.$product->shortName.') | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Inventories <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('inventories') }}" class="text-primary" title="Inventories">Inventories</a></li>
                    <li>Add</li>
                    <li>Step Two</li>
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
                        <button type="button" class="btn-back" data-url="{{ route('inventories') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Add</h3>
            </div>
            <div class="block-content">
                <div class="block-content block-content-full">
                    <!-- .block-content -->
                    {!! Form::open([
                         'id' => 'inventories',
                         'method' => 'post',
                         'class' => 'form-horizontal push-20-t',
                         'enctype' => 'multipart/form-data',
                         'url' => route('inventoriesAdd')
                         ])
                    !!}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="col-lg-2 col-md-8 col-sm-3 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('productsId', 'Product ID') !!}
                                {!! Form::text('productsId', $product->productsId, ['class'=>'form-control', 'id'=>'productsId','readonly'=>true ]) !!}

                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('productsName', 'Products Name') !!}
                                {!! Form::text('productsName', (($product->shortName) ? $product->shortName : $product->description), ['class'=>'form-control', 'id'=>'productsName' ,'readonly'=>true]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-8 col-sm-3 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('category', 'Category') !!}
                                {!! Form::text('category', $product->category->name, ['class'=>'form-control', 'id'=>'category' ,'readonly'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('minOld', 'Minimum Balance Current') !!}
                                {!! Form::text('minOld',$product->min, ['class'=>'form-control', 'id'=>'minOld', 'maxlength'=>10, 'readonly'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('maxOld', 'Maximum Balance Current') !!}
                                {!! Form::text('maxOld', $product->max, ['class'=>'form-control', 'id'=>'maxOld', 'maxlength'=>10, 'readonly'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('quantityOld', 'Quantity Current') !!}
                                {!! Form::text('quantityOld',  $product->quantity, ['class'=>'form-control', 'id'=>'quantityOld', 'readonly'=>true]) !!}
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('costPriceOld', 'Price Begin Current') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('costPriceOld',$product->costPrice, ['class'=>'form-control', 'id'=>'costPriceOld', 'maxlength'=>10,'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('salePriceOld', 'Sale Price Current') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('salePriceOld', $product->salePrice, ['class'=>'form-control', 'id'=>'salePriceOld', 'maxlength'=>10, 'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountMoneyOld', 'Maximum Money Current') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('discountMoneyOld', $product->discountMoney, ['class'=>'form-control', 'id'=>'discountMoneyOld', 'maxlength'=>6 , 'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountOld', 'Maximum discount Current') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    {!! Form::text('discountOld', $product->discount, ['class'=>'form-control', 'id'=>'discountOld', 'maxlength'=>5 , 'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <HR>

                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('min', 'Minimum Balance *') !!}
                                {!! Form::text('min','', ['class'=>'form-control', 'id'=>'min', 'maxlength'=>10]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('max', 'Maximum Balance *') !!}
                                {!! Form::text('max','' , ['class'=>'form-control', 'id'=>'max', 'maxlength'=>10]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('finalQuantity', 'FinalQuantity *') !!}
                                {!! Form::text('finalQuantity', '', ['class'=>'form-control', 'id'=>'finalQuantity', 'maxlength'=>5]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('priceBegin*', 'Price Begin') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('costPrice','', ['class'=>'form-control', 'id'=>'costPrice', 'maxlength'=>5]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('salePrice*', 'Sale Price*') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('salePrice', '', ['class'=>'form-control', 'id'=>'salePrice', 'maxlength'=>5]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountMoney', 'Maximum Money *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('discountMoney','', ['class'=>'form-control', 'id'=>'discountMoney', 'maxlength'=>6]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discount', 'Maximum discount *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    {!! Form::text('discount','', ['class'=>'form-control', 'id'=>'discount', 'maxlength'=>2]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('description', 'Description *') !!}
                                {!! Form::text('description','', ['class'=>'form-control', 'id'=>'description', 'maxlength'=>200]) !!}
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
    <script src="{{ asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
    {{-- Add MASK MONEY plugin --}}
    <script src="{{ asset('assets/js/jquery.maskmoney.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            // Apply mask money funtion to input
           // $('#min').maskMoney();
            $("#min").mask("999999");
            $('#max').mask("999999");
            $('#costPrice').maskMoney();
            $('#salePrice').maskMoney();
            $('#discountMoney').maskMoney();
            $('#discount').mask("99");
            $('#finalQuantity').mask("999999");

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
                     'costPrice': {
                        required: true,
                         number: true
                    },
                    'salePrice': {
                        required: true,
                        number: true
                    },
                    'finalQuantity': {
                        required: true,
                        number: true
                    },
                    'min': {
                        required: true,
                        number: true
                    },
                    'max': {
                        required: true,
                        number: true
                    },
                    'discountMoney': {
                        required: true,
                        number: true
                    },
                    'discount': {
                        required: true,
                        number: true
                    },
                    'type': {
                        required: true,
                        number: true
                    },
                }
            });
        });
    </script>
@stop