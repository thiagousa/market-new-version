@extends('template.admin')

@section('content')
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <div class="block block-themed animated fadeIn">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <a href="{{ route('login') }}"  title="Log In"><i class="si si-login"></i> Login</a>
                        </li>
                    </ul>
                    <h3 class="block-title">Reset Password</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <img src="{{ asset('assets/img/logoLogin.png') }}" alt="{{ config('app.name') }}" class="center-block" width="80%" />

                    @if (session('status'))
                    <div class="alert alert-primary-primary">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="js-validation-reminder form-horizontal push-50-t push-50" action="{{ url('password/email') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary">
                                    <input class="form-control" type="text" placeholder="Enter your email" id="email" value="{{ old('email') }}" name="email">
                                    <label for="email">Email</label>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-5">
                                <button class="btn btn-block btn-primary" type="submit"><i class="si si-envelope-open pull-right"></i> Send Mail</button>
                            </div>
                        </div>
                    </form><!-- END Forgot Form -->
                </div>
            </div><!-- END Forgot Block -->
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="application/javascript">
$(function(){
    $('.js-validation-reminder').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group .form-material').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        rules: {
            'email': {
                required: true,
                email: true
            }
        },
        messages: {
            'email': {
                required: 'Please enter your email'
            }
        }
    });
});
</script>
@stop