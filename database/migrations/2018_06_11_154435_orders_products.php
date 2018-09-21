<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersProducts', function (Blueprint $table) {
            $table->increments('ordersProductsId')->unique();
            $table->integer('ordersId')->unsigned();
            $table->foreign('ordersId')->references('ordersId')->on('orders')->onDelete('cascade');
            $table->integer('productsId')->unsigned();
            $table->foreign('productsId')->references('productsId')->on('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->float('unitPrice', 10, 2);
            $table->float('totalPrice', 10, 2);
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
        if (Schema::hasTable('ordersProducts')){
            Schema::dropForeign('ordersproducts_ordersid_foreign');
            Schema::dropForeign('ordersproducts_productsid_foreign');
            Schema::drop('ordersProducts');
        }
    }
}
