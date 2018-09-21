<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsBarcode extends Model
{
    use SoftDeletes;

    protected $table = 'productsBarcode';

    protected $primaryKey = 'productsBarcodeId';
}
