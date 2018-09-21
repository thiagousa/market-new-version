<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('inventoriesId')->unique();
            $table->integer('productsId')->unsigned();
            $table->foreign('productsId')->references('productsId')->on('products');
            $table->float('costPriceOld', 10, 2);
            $table->float('salePriceOld', 10, 2);
            $table->integer('quantityOld')->nullable();
            $table->float('minOld');
            $table->float('maxOld');
            $table->float('discountMoneyOld', 10, 2);
            $table->integer('discountOld');
            $table->float('costPrice', 10, 2);
            $table->float('salePrice', 10, 2);
            $table->integer('quantity')->nullable();
            $table->float('min');
            $table->float('max');
            $table->float('discountMoney', 10, 2);
            $table->integer('discount');
                $table->string('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('inventories'))
        {
            Schema::dropForeign('inventories_productsid_foreign');
            Schema::drop('inventories');
        }
    }
}