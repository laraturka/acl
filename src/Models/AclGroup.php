<?php

namespace Laraturka\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class AclGroup extends Model
{
    public function users(){
        return $this->belongsToMany('Users', 'acl_user_groups');
    }

    public function controllers(){
        return $this->hasMany('Laraturka\Acl\Models\AclController');
    }

    public function gates(){
        return $this->belongsToMany('Laraturka\Acl\Models\AclGate', 'acl_gate_groups');
    }

}
