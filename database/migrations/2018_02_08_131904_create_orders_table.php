<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('ordersId')->unique();
            $table->integer('promotersId')->unsigned();
            $table->foreign('promotersId')->references('promotersId')->on('promoters')->onDelete('cascade');
            $table->float('finalValue', 10, 2)->nullable();
            $table->integer('status');
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
        if (Schema::hasTable('orders')){
            Schema::dropForeign('orders_promotersid_foreign');
            Schema::drop('orders');
        }
    }
}