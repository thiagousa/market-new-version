<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsBarcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productsBarcode', function (Blueprint $table) {
            $table->increments('productsBarcodeId')->unique();
            $table->integer('productsId')->unsigned();
            $table->foreign('productsId')->references('productsId')->on('products');
            $table->string('barcode', 50);
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
        if (Schema::hasTable('productsBarcode'))
        {
            Schema::dropForeign('productsbarcode_productsid_foreign');
            Schema::drop('productsBarcode');
        }
    }
}
