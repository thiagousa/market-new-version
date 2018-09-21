<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeCustomers extends Model
{
    use SoftDeletes;

    protected $table = 'typeCustomers';

    protected $primaryKey = 'typeCustomersId';
}
