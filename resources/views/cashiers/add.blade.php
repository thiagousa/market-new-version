@extends('admin.sidebar-template')

@section('title', 'Edit Drawer | ')

@section('page-content')
    @parent
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Drawers <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li><a href="{{ route('drawers') }}" class="text-primary" title="Drawers">Drawers</a></li>
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
                            <button type="button" class="btn-back" data-url="{{ route('drawers') }}"><i class="si si-action-undo"></i></button>
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
                        <!-- .block-content -->
                        <div class="block-content block-content-full">
                            {!! Form::open([
                                'id' => 'drawers',
                                'method' => 'post',
                                'class' => 'form-horizontal push-20-t',
                                'enctype' => 'multipart/form-data',
                                'url' => route('drawersAdd')
                                ])
                            !!}

                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('Number', 'Number *') !!}
                                    {!! Form::text('number','', ['class'=>'form-control', 'id'=>'number', 'maxlength'=>2]) !!}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('Value', 'Value *') !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        {!! Form::text('value', '', ['class'=>'form-control', 'id'=>'value', 'maxlength'=>8]) !!}
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
    {{-- Add MASK MONEY plugin --}}
    <script src="{{ asset('assets/js/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
    {{-- Add MASK MONEY plugin --}}
    <script src="{{ asset('assets/js/jquery.maskmoney.js') }}"></script>
    <script type="application/javascript">
        $(function(){
            // Apply mask money funtion to input

            $('#value').maskMoney();

            $('#number').mask("99");

            });



        $(function(){


            // FRONT END VALIDATION
            $('.form-horizontal').validate({
                errorClass: 'help-block text-right animated fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group .form-input').append(error);
                },
                highlight: function(e) {
                    jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                    jQuery(e).closest('.help-block').remove();
                },
                success: function(e) {
                    jQuery(e).closest('.form-group').removeClass('has-error');
                    jQuery(e).closest('.help-block').remove();
                },
                ignore: [],
                rules: {
                    'number': {
                        required: true,
                    },
                    'value': {
                        required: true,


                    }
                }
            });
        });
    </script>
@stop
