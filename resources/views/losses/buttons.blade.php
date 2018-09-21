{!! Form::button('<i class="fa fa-check"></i>', ['title'=>'Choose', 'data-toggle'=>'tooltip', 'class'=>'btn btn-xs btn-info',
                 'onclick'=>'window.open(\''.route('lossesAddStepTwo', $row[0]).'\', \'_self\')']) !!}
{!! Form::close() !!}