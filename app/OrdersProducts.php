<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Exceptions\Money;

class OrdersProducts extends Model
{
    use SoftDeletes;

    protected $table = 'ordersProducts';

    protected $primaryKey = 'ordersProductsId';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function order()
    {
        return $this->belongsTo('App\Orders','ordersId','ordersId');
    }

    public function product()
    {
        return $this->belongsTo('App\Products','productsId','productsId');
    }

    /**
     * Get the orders products' unit price.
     *
     * @return string
     */
    public function getUnitPriceAttribute()
    {
        return '$' . Money::convertDatabaseToView($this->attributes['unitPrice'], 2, '.', ',');
    }

    /**
     * Get the orders products' total price.
     *
     * @return string
     */
    public function getTotalPriceAttribute()
    {
        return '$' . Money::convertDatabaseToView($this->attributes['totalPrice'], 2, '.', ',');
    }
}
