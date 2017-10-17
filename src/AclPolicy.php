<?php

namespace Laraturka\Acl;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class AclPolicy
{
    use HandlesAuthorization;

    public function before($user, $gate){
    	$count = DB::table('users')
            ->select('acl_gates.*')
            ->join('acl_user_groups', 'acl_user_groups.user_id', '=', 'users.id')
            ->join('acl_groups', 'acl_groups.id', '=', 'acl_user_groups.acl_group_id')
            ->join('acl_gates', 'acl_gates.acl_group_id', '=', 'acl_groups.id')
            ->where('users.id', '=', $user->id )
            ->where(function ($q) use($gate) { //Check if name is null or equal
                $q  ->whereNull('acl_gates.name')
                    ->orWhere('acl_gates.name', $gate);
            })
            ->count();

        return $count>0;
    }

    public function __call($method, $args) {
        return false;
    }

}