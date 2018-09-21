<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'categoriesId';

    /**
     * Function to list all products related to each category through foreign key
     * and using eloquent hasMany method
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Products::class,'categoriesId','categoriesId');
    }
}
