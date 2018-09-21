@extends('admin.sidebar-template')

@section('title', 'View Inventory | ')

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
                    <li>View</li>
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
                <h3 class="block-title">View</h3>
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
                            'id' => 'inventories',
                            'method' => 'get',
                            'class' => 'form-horizontal push-20-t',
                            'url' => route('inventories')
                        ])
                    !!}
                    {!! Form::hidden('inventoriesId', $inventories->Id) !!}
                    <div class="form-group">
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('inventoriesId', 'ID') !!}
                                {!! Form::text('inventoriesId', $inventories->inventoriesId, ['class'=>'form-control', 'id'=>'inventoriesId', 'maxlength'=>100, 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('productsId', 'Product ID *') !!}
                                {!! Form::text('productsId', $inventories->productsId, ['class'=>'form-control', 'id'=>'productsId', 'maxlength'=>5, 'disabled'=>true]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                        <div class="form-input">
                            {!! Form::label('productsName', 'Products Name') !!}
                            {!! Form::text('productsName', (($inventories->product->shortName) ? $inventories->product->shortName : $inventories->product->description), ['class'=>'form-control', 'id'=>'productsName', 'disabled'=>true]) !!}
                        </div>
                    </div>

                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                        <div class="form-input">
                            {!! Form::label('category', 'Category') !!}
                            {!! Form::text('category', $inventories->product->category->name, ['class'=>'form-control', 'id'=>'category' ,'disabled'=>true]) !!}
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('minOld', 'Minimum Balance Last') !!}
                                {!! Form::text('minOld',$inventories->minOld, ['class'=>'form-control', 'id'=>'min', 'maxlength'=>10, 'readonly'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('maxOld', 'Maximum Balance Last') !!}
                                {!! Form::text('maxOld', $inventories->maxOld, ['class'=>'form-control', 'id'=>'max', 'maxlength'=>10, 'readonly'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('quantityOld', 'Quantity Last') !!}
                                {!! Form::text('quantityOld',  $inventories->quantityOld, ['class'=>'form-control', 'id'=>'quantity', 'readonly'=>true]) !!}
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('priceBeginOld', 'Price Begin Last') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('costPriceOld',$inventories->costPriceOld, ['class'=>'form-control', 'id'=>'costPrice', 'maxlength'=>2,'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('salePriceOld', 'Sale Price Last') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('salePriceOld', $inventories->salePriceOld, ['class'=>'form-control', 'id'=>'salePrice', 'maxlength'=>2, 'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountMoneyOld', 'Maximum Money Last') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('discountMoneyOld', $inventories->discountMoneyOld, ['class'=>'form-control', 'id'=>'discountMoney', 'maxlength'=>6 , 'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountOld', 'Maximum discount Last') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    {!! Form::text('discountOld', $inventories->discountOld, ['class'=>'form-control', 'id'=>'discount', 'maxlength'=>5 , 'readonly'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('min', 'Minimum Balance *') !!}
                                {!! Form::text('min',$inventories->min, ['class'=>'form-control', 'id'=>'min', 'maxlength'=>10,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('max', 'Maximum Balance *') !!}
                                {!! Form::text('max', $inventories->max, ['class'=>'form-control', 'id'=>'max', 'maxlength'=>10,'disabled'=>true]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('finalQuantity', 'FinalQuantity *') !!}
                                {!! Form::text('finalQuantity', $inventories->quantity, ['class'=>'form-control', 'id'=>'finalQuantity', 'maxlength'=>5,'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('priceBegin', 'Price Begin') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('costPrice',$inventories->costPrice, ['class'=>'form-control', 'id'=>'costPrice', 'maxlength'=>2,'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('salePrice', 'Sale Price') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('salePrice', $inventories->salePrice, ['class'=>'form-control', 'id'=>'salePrice', 'maxlength'=>2,'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discountMoney', 'Maximum Money *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('discountMoney', $inventories->discountMoney, ['class'=>'form-control', 'id'=>'discountMoney', 'maxlength'=>6,'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('discount', 'Maximum discount *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    {!! Form::text('discount', $inventories->discount, ['class'=>'form-control', 'id'=>'discount', 'maxlength'=>5,'disabled'=>true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('description', 'Description *') !!}
                                {!! Form::text('description',$inventories->description, ['class'=>'form-control', 'id'=>'description', 'maxlength'=>200,'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 push-30-t">
                            {!! Form::submit('Back', ['class'=>'btn btn-primary pull-left']) !!}
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