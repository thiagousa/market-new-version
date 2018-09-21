<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashiers extends Model
{
    use SoftDeletes;

    protected $table = 'cashiers';

    protected $primaryKey = 'cashierId';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function drawers()
    {
        return $this->belongsTo(Drawers::class, 'drawerId', 'drawerId');
    }

    public function moneyFormatted($value)
    {
        return number_format($value,2,'.',',');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }


}