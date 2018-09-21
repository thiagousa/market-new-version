<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Losses extends Model
{
    use SoftDeletes;

    protected $table = 'losses';

    protected $primaryKey = 'lossesId';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Function to get product data through foreign key
     * and using eloquent belongsTo method
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Products', 'productsId', 'productsId');
    }
}
