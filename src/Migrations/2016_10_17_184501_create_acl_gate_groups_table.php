<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclGateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_gate_groups', function (Blueprint $table) {
            $table->unsignedInteger('acl_gate_id');
            $table->unsignedInteger('acl_group_id');
            $table->timestamps();

            $table->primary(['acl_gate_id', 'acl_group_id']);

            $table->foreign('acl_group_id')->references('id')->on('acl_groups');
            $table->foreign('acl_gate_id')->references('id')->on('acl_gates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_gate_groups');
    }
}
