<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('losses', function (Blueprint $table) {
            $table->increments('lossesId')->unique();
            $table->integer('productsId')->unsigned();
            $table->foreign('productsId')->references('productsId')->on('products');
            $table->integer('quantity')->nullable();
            $table->integer('loss')->nullable();
            $table->integer('finalQuantity')->nullable();
            $table->string('type');
            $table->string('description')->nullable();
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
        if (Schema::hasTable('losses'))
        {
            Schema::dropForeign('losses_productsid_foreign');
            Schema::drop('losses');
        }
    }
}