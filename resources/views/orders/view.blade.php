@extends('admin.sidebar-template')

@section('title', 'View Order | ')

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
                        <button type="button" class="btn-back" data-url="{{ route('orders') }}"><i class="si si-action-undo"></i></button>
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
                            'id' => 'orders',
                            'method' => 'get',
                            'class' => 'form-horizontal push-20-t',
                            'url' => route('orders')
                        ])
                    !!}

                    {!! Form::hidden('ordersId', $order->ordersId) !!}
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('ordersId', 'ID') !!}
                                {!! Form::text('ordersId', $order->ordersId, ['class'=>'form-control', 'id'=>'ordersId', 'maxlength'=>100, 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('finalValue', 'Final Value') !!}
                                {!! Form::text('finalValue', $order->finalValue, ['class'=>'form-control', 'id'=>'finalValue', 'maxlength'=>5, 'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Status', 'Status') !!}
                                {!! Form::text('Status', $order->status, ['class'=>'form-control', 'id'=>'finalValue', 'maxlength'=>5, 'disabled'=>true]) !!}
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('promotersName', 'Promoter Name') !!}
                                {!! Form::text('promotersName',$order->promoter->name, ['class'=>'form-control', 'id'=>'productsName', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Sponsor', 'Sponsor') !!}
                                {!! Form::text('Sponsor',$order->promoter->sponsor, ['class'=>'form-control', 'id'=>'Sponsor', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>

                    <br>
                    <h4>Products List</h4>
                    <hr>
                    @foreach($order->products as $product)
                    <div class="form-group">
                        <div class="col-lg-5 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Description', 'Description ') !!}
                                {!! Form::text('quantity', $product->product->shortName, ['class'=>'form-control', 'id'=>'Description', 'maxlength'=>100,'disabled'=>true]) !!}
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Quantity', 'Quantity ') !!}
                                {!! Form::text('Quantity', $product->quantity, ['class'=>'form-control', 'id'=>'Quantity', 'maxlength'=>5,'disabled'=>true]) !!}
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('costPrice', 'CostPrice') !!}
                                {!! Form::text('costPrice', $product->unitPrice, ['class'=>'form-control', 'id'=>'Quantity', 'maxlength'=>5,'disabled'=>true]) !!}
                            </div>
                        </div>

                        <div class="col-lg- col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('valueTotal ', 'Value Total ') !!}
                                {!! Form::text('valueTotal', $product->totalPrice, ['class'=>'form-control', 'id'=>'valueTotal', 'maxlength'=>5,'disabled'=>true]) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
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