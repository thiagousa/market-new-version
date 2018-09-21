{!! Form::button('<i class="fa fa-pencil"></i>', ['title'=>'Edit', 'data-toggle'=>'tooltip', 'class'=>'btn btn-xs btn-success',
                 'onclick'=>'window.open(\''.route('productsEdit', $row[0]).'\', \'_self\')']) !!}

{!! Form::open([
        'id' => 'formDelete'.$row[0],
        'method' => 'delete',
        'enctype' => 'multipart/form-data',
        'url' => ''
    ])
!!}
    {!! Form::hidden('productsId', $row[0]) !!}
    {!! Form::button('<i class="fa fa-trash"></i>', ['title'=>'Delete', 'data-toggle'=>'tooltip', 'class'=>'btn btn-xs btn-danger btn-delete',
                     'data-url'=>route('productsDelete'), 'data-form'=>1, 'data-id-form'=>'formDelete'.$row[0]]) !!}
{!! Form::close() !!}