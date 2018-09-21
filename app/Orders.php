<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Exceptions\Money;

class Orders extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $primaryKey = 'ordersId';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $status = [
        1 => 'Requested',
        2 => 'Done',
        3 => 'Received',
        4 => 'Cancelled'
    ];

    /**
     * Get Promoter's data
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promoter()
    {
        return $this->belongsTo('App\Promoters', 'promotersId', 'promotersId');
    }

    /**
     * Get products list from orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
       return $this->hasMany('App\OrdersProducts', 'ordersId', 'ordersId');
    }

    /**
     * Get the orders' final value.
     *
     * @return string
     */
    public function getFinalValueAttribute()
    {
        return '$' . Money::convertDatabaseToView($this->attributes['finalValue'], 2, '.', ',');
    }

    /**
     * Get the orders' status name.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        return self::$status[$this->attributes['status']];
    }
}
