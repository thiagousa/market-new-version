<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $primaryKey = 'customersId';

    public function type()
    {
        return $this->belongsTo(TypeCustomers::class, 'typeCustomersId', 'typeCustomersId');
    }

}
