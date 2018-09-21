@extends('admin.sidebar-template')

@section('title', 'Edit Cashier | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Cashiers <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('cashiers') }}" class="text-primary" title="Cashiers">Cashiers</a></li>
                    <li>{{ $cashier->name }}</li>
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
                        <button type="button" class="btn-back" data-url="{{ route('cashiers') }}"><i class="si si-action-undo"></i></button>
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
                        'id' => 'cashier',
                        'method' => 'put',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('cashiersEditPut')
                        ])
                    !!}

                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Number', 'Number *') !!}
                                {!! Form::text('cashierId', $cashier->cashierId, ['class'=>'form-control', 'id'=>'cashierId']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Drawer', 'Drawer') !!}
                                <div class="input-group">
                                    {!! Form::text('drawerId', $cashier->drawerId, ['class'=>'form-control', 'id'=>'drawer', 'maxlength'=>100]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Value Begin', 'Value Begin') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>

                                {!! Form::text('value_inicial',
                                $cashier->moneyFormatted($cashier->value_inicial), ['class'=>'form-control', 'id'=>'value_begin', 'maxlength'=>2]) !!}
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('Value Final', 'Value final') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('value_final',$cashier->moneyFormatted($cashier->value_inicial) , ['class'=>'form-control', 'id'=>'value_final', 'maxlength'=>100]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('Name', 'Name') !!}
                                    {!! Form::text('name', $cashier->user->name, ['class'=>'form-control', 'id'=>'name', 'maxlength'=>2]) !!}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('Date', 'Date') !!}

                                        {!! Form::text('date', $cashier->created_at->format('m/d/Y'), ['class'=>'form-control', 'id'=>'date', 'maxlength'=>100]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-xs-12 push-30-t">
                            {!! Form::submit('Close Cashier', ['class'=>'btn btn-primary pull-left']) !!}
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
    <script src="{{ asset('assets/js/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
    {{-- Add MASK MONEY plugin --}}
    <script src="{{ asset('assets/js/jquery.maskmoney.js') }}"></script>
    <script type="application/javascript">

    </script>
@stop

