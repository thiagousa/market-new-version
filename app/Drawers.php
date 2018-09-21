<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drawers extends Model
{
    use SoftDeletes;

    protected $table = 'drawers';

    protected $primaryKey = 'drawerId';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function moneyFormatted()
    {
        return number_format($this->value,2,'.',',');
    }



    public function cashiers()
    {
        return $this->hasMany(Cashiers::class, 'cashierId');
    }
}

