<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acl_groups')->insert([
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Editor'],
            ['id' => 3, 'name' => 'Moderator']
        ]);

        DB::table('acl_user_groups')->insert([
            ['user_id' => 1, 'acl_group_id' => 1],
        ]);

        DB::table('acl_gates')->insert([
            ['id' => 1, 'name' => null], //admin rule
            ['id' => 2, 'name' => 'upload'],
        ]);

        DB::table('acl_gate_groups')->insert([
            ['acl_group_id' => 1, 'acl_gate_id' => 1], //admin
        ]);

        DB::table('acl_controllers')->insert([
            ['id' => 1, 'acl_group_id' => 1, 'controller' => null, 'method' => null], //admin
            //['id' => 2, 'acl_group_id' => 2, 'controller' => 'Admin\PageAdminController', 'method' => null], //page admin for Editor
        ]);
    }
}
