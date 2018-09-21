<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventories extends Model
{
    use SoftDeletes;

    protected $table = 'inventories';

    protected $primaryKey = 'inventoriesId';

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
