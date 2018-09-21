<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('productsId')->unique();
            $table->string('description');//->unique();
            $table->string('shortName');
            $table->string('brand');
            $table->integer('categoriesId')->unsigned();
            $table->float('costPrice', 10, 2);
            $table->float('salePrice', 10, 2);
            $table->string('codeBalance')->nullable();//->unique();
            $table->string('codeBegin')->nullable();
            $table->string('codeEnd')->nullable();
            $table->string('priceBegin')->nullable();
            $table->string('priceEnd')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('min');
            $table->float('max');
            $table->float('discountMoney', 10, 2);
            $table->integer('discount');
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
        if (Schema::hasTable('products'))
        {
            Schema::drop('products');
        }
    }
}