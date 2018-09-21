<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('settingsId');
            $table->string('title', 100);
            $table->string('email', 50);
            $table->string('favicon', 255);
            $table->string('avatar', 255);
            $table->string('appleTouchIcon', 255);
            $table->boolean('maintenance', 1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('settings'))
        {
            Schema::drop('settings');
        }
    }
}
