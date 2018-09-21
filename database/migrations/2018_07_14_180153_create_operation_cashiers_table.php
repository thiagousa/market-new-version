<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationCashiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_cashiers', function (Blueprint $table) {
            $table->increments('operation_cashierId');
            $table->integer('cashierId')->unsigned();
            $table->float('value', 10, 2);
            $table->float('value_final', 10, 2);
            $table->string('description')->nullable();
            $table->boolean('type');// valor a - r retirado
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_cashiers');
    }
}
