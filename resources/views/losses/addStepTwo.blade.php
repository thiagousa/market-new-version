
@extends('admin.sidebar-template')

@section('title', 'Add Loss ('.$product->shortName.') | ')

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
                        <button type="button" class="btn-back" data-url="{{ route('losses') }}"><i class="si si-action-undo"></i></button>
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
                         'id' => 'losses',
                         'method' => 'post',
                         'class' => 'form-horizontal push-20-t',
                         'enctype' => 'multipart/form-data',
                         'url' => route('lossesAdd')
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
                        <div class="col-lg-1 col-md-8 col-sm-3 col-xs-12">
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
                        <div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('quantity', 'Quantity') !!}
                                {!! Form::text('quantity',  $product->quantity, ['class'=>'form-control', 'id'=>'quantity', 'readonly'=>true]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Losses', 'Losses *') !!}
                                {!! Form::text('loss', '', ['class'=>'form-control', 'id'=>'loss', 'maxlength'=>5]) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('type', 'Type *') !!}
                                {{ Form::select('type', $types, null, ['class' => 'form-control', 'id'=>'type']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
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
{{-- Add MASK MONEY plugin --}}
<script src="{{ asset('assets/js/jquery.maskmoney.js') }}"></script>
<script type="text/javascript">
$(function(){
    // Apply mask money funtion to input
    $('#finalQuantity').maskMoney(10,0,0);
    // FRONT END VALIDATION
    $('.form-horizontal').validate({
        ignore: [],
        rules: {
            'finalQuantity': {
                required: true,
                number: true
            },
            'type': {
                required: true
            },
            'description': {
                required: true
            }
        }
    });
});
</script>
@stop