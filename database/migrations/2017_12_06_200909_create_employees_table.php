<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employeesId');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->unique();
            $table->string('cellphone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->char('state', 2)->nullable();
            $table->string('country', 100);
            $table->string('zipcode', 10)->nullable();
            $table->string('function', 45);
            $table->date('dateBegin');
            $table->date('dateEnd')->nullable();
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
        if (Schema::hasTable('employees'))
        {
            Schema::drop('employees');
        }
    }
}
