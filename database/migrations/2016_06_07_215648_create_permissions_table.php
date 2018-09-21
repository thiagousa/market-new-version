<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('permissionsId');
            $table->integer('userId')->unsigned();
            $table->char('pageAdminId', 40);
            $table->boolean('access');
            $table->boolean('add');
            $table->boolean('edit');
            $table->boolean('delete');
            $table->foreign('pageAdminId')->references('pagesAdminId')->on('pagesAdmin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        if (Schema::hasTable('permissions'))
        {
            Schema::drop('permissions', function (Blueprint $table) {
                $table->dropForeign('permissions_userid_foreign');
                $table->dropForeign('permissions_pageadminid_foreign');
            });
        }
    }
}
