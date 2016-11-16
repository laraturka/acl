<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_controllers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('acl_group_id')->index();
            $table->string('controller')->nullable()->index();
            $table->string('method')->nullable()->index();
            $table->timestamps();

            $table->foreign('acl_group_id')->references('id')->on('acl_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_controllers');
    }
}
