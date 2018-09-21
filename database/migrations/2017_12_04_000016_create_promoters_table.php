<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoters', function (Blueprint $table) {
            $table->increments('promotersId');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->unique();
            $table->string('cellphone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->char('state', 2)->nullable();
            $table->string('country', 100);
            $table->string('zipcode', 10)->nullable();
            $table->string('sponsor', 100);
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
        if (Schema::hasTable('promoters'))
        {
            Schema::drop('promoters');
        }
    }
}
