<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_user_groups', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('acl_group_id');
            $table->timestamps();

            $table->primary(['user_id', 'acl_group_id']);

            $table->foreign('acl_group_id')->references('id')->on('acl_groups');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_user_groups');
    }
}
