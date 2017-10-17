<?php


namespace Laraturka\Acl;
use Illuminate\Support\Facades\DB;

trait AclHasGate
{

    public function hasGroup($group)
    {

        if (is_string($group)) {
            return $this->Groups->contains('name', $group);
        }

        //check if exists mached user grous and gate groups
        return !! $group->intersect($this->groups)->count();
    }

    public function hasGate($gate)
    {
        return $this->checkIfAuthorized($gate);
    }

    public function checkIfGateAuthorized($gate){

        //gate name is null means wildcard allowed
        $count = DB::table('users')
            ->select('acl_gates.*')
            ->join('acl_user_groups', 'acl_user_groups.user_id', '=', 'users.id')
            ->join('acl_groups', 'acl_groups.id', '=', 'acl_user_groups.acl_group_id')
            ->join('acl_gates', 'acl_gates.acl_group_id', '=', 'acl_groups.id')
            ->where('users.id', '=', $this->id )
            ->where(function ($q) use($gate) { //Check if name is null or equal
                $q  ->whereNull('acl_gates.name')
                    ->orWhere('acl_gates.name', $gate);
            })
            ->count();

        return $count>0;
    }

}