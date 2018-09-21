@extends('admin.sidebar-template')

@section('title', 'View Loss | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Losses <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('losses') }}" class="text-primary" title="Losses">Losses</a></li>
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
                        <button type="button" class="btn-back" data-url="{{ route('losses') }}"><i class="si si-action-undo"></i></button>
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
                            'id' => 'losses',
                            'method' => 'get',
                            'class' => 'form-horizontal push-20-t',
                            'url' => route('losses')
                        ])
                    !!}
                    {!! Form::hidden('lossesId', $losses->Id) !!}
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('lossesId', 'ID') !!}
                                {!! Form::text('lossesId', $losses->lossesId, ['class'=>'form-control', 'id'=>'lossesId', 'maxlength'=>100, 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('productsId', 'Product ID *') !!}
                                {!! Form::text('productsId', $losses->productsId, ['class'=>'form-control', 'id'=>'productsId', 'maxlength'=>5, 'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('productsName', 'Product Name') !!}
                                {!! Form::text('productsName', (($losses->product->shortName) ? $losses->product->shortName : $losses->product->description), ['class'=>'form-control', 'id'=>'productsName', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('category', 'Category') !!}
                                    {!! Form::text('category', $losses->product->category->name, ['class'=>'form-control', 'id'=>'category', 'maxlength'=>5,'disabled'=>true]) !!}

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('quantity', ' Current Qty Product *') !!}
                                {!! Form::text('quantity', $losses->product->quantity, ['class'=>'form-control', 'id'=>'quantity', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('quantity', 'Last Quantity Product*') !!}
                                {!! Form::text('quantity', $losses->quantity, ['class'=>'form-control', 'id'=>'quantity', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Losses', 'Losses*') !!}
                                {!! Form::text('loss', $losses->loss, ['class'=>'form-control', 'id'=>'loss', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('finalQuantity', 'Final Quantity *') !!}
                                {!! Form::text('finalQuantity', $losses->finalQuantity, ['class'=>'form-control', 'id'=>'finalQuantity', 'maxlength'=>5,'disabled'=>true]) !!}
                            </div>
                        </div>
                            <div class="col-lg-1 col-md-6 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('type', 'Type *') !!}
                                    {!! Form::text('type', $losses->type, ['class'=>'form-control', 'id'=>'type', 'maxlength'=>100,'disabled'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-8 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('updated_at', 'Date *') !!}
                                    {!! Form::text('updated_at', $losses->updated_at->format('m/d/y'), ['class'=>'form-control', 'id'=>'updated_at', 'maxlength'=>5,'disabled'=>true]) !!}

                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('description', 'Description *') !!}
                                {!! Form::text('description', $losses->description, ['class'=>'form-control', 'id'=>'description', 'maxlength'=>5,'disabled'=>true]) !!}
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