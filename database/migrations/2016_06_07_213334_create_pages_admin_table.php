<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePagesAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagesAdmin', function (Blueprint $table) {
            $table->char('pagesAdminId', 40);
            $table->string('title', 50);
            $table->string('icon', 20);
            $table->integer('sortorder');
            $table->primary('pagesAdminId');
            $table->unique(['pagesAdminId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('pagesAdmin'))
        {
            Schema::drop('pagesAdmin');
        }
    }
}
