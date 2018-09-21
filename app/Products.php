<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'productsId';

    /**
     * Function to get category data of each product through foreign key
     * and using eloquent belongsTo method
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function category()
{
    return $this->belongsTo(Categories::class, 'categoriesId', 'categoriesId');
}
    public function losses()
    {
        return $this->hasMany(Products::class, 'productsId', 'productsId');
    }

    public function barCodes()
    {
        return $this->hasMany(ProductsBarcode::class, 'productsId', 'productsId');
    }
}
