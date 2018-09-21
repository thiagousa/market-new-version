<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use SoftDeletes;

    protected $table = 'employees';

    protected $primaryKey = 'employeesId';

}
