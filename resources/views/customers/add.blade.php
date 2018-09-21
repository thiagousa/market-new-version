@extends('admin.sidebar-template')

@section('title', 'Add Customer | ')

@section('head')
@parent
<!-- Page JS Plugins CSS -->
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
                    Customers <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('customers') }}" class="text-primary" title="Customers">Customers</a></li>
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
                        <button type="button" class="btn-back" data-url="{{ route('customers') }}"><i class="si si-action-undo"></i></button>
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
                        'id' => 'customers',
                        'method' => 'post',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('customersAdd')
                        ])
                    !!}
                    <div class="form-group">
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('namecia', 'Companhia') !!}
                                {!! Form::text('namecia', '', ['class'=>'form-control', 'id'=>'namecia', 'maxlength'=>255]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('name', 'Name *') !!}
                                {!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name', 'maxlength'=>100]) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('email', 'Email *') !!}
                                {!! Form::text('email', '', ['class'=>'form-control', 'id'=>'email', 'maxlength'=>100]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('phone', 'Phone *') !!}
                                {!! Form::text('phone', '', ['class'=>'form-control', 'id'=>'phone', 'maxlength'=>20]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('cellphone', 'CellPhone') !!}
                                {!! Form::text('cellphone', '', ['class'=>'form-control', 'id'=>'cellphone', 'maxlength'=>20]) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <br>
                            <label><input type="checkbox" name="samePhone" id="samePhone" value="1">  The same phone</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('address', 'Address') !!}
                                {!! Form::text('address', '', ['class'=>'form-control', 'id'=>'address', 'maxlength'=>255]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('city', 'City') !!}
                                {!! Form::text('city', '', ['class'=>'form-control', 'id'=>'city', 'maxlength'=>100]) !!}
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('state', 'State') !!}
                                {!! Form::text('state', '', ['class'=>'form-control', 'id'=>'state', 'maxlength'=>2]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('zipcode', 'Zipcode') !!}
                                {!! Form::text('zipcode', '', ['class'=>'form-control', 'id'=>'zipcode', 'maxlength'=>10]) !!}
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-6">
                            <div class="form-input">
                                {!! Form::label('country', 'Country *') !!}
                                {!! Form::text('country', '', ['class'=>'form-control', 'id'=>'country', 'maxlength'=>100]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12">
                            <div class="form-input">
                                {!! Form::label('typeCustomersId', 'Type:') !!}
                                {!! Form::select('typeCustomersId', $typeCustomers, '', ['id' => 'typeCustomersId', 'class' => 'form-control']) !!}
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
<script src="{{ asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
$(function(){

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
            'name': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'phone': {
                required: true
            },
            'country': {
                required: true
            }
        }
    });
    // Init page helpers (BS Datepicker + Masked Input)
    App.initHelpers(['datepicker', 'masked-inputs']);
    // THE SAME PHONE
    $('#samePhone').click(function () {
        if($(this).is(':checked')){
            var phone = $('#phone').val();
            $('#cellphone').attr('readonly', true);
            $('#cellphone').val(phone);
        }else{
            $('#cellphone').attr('readonly', false);
            $('#cellphone').val('');
            $('#cellphone').focus();
        }
    });
});
</script>
@stop
