<?php

namespace Laraturka\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class AclGate extends Model
{
    public function groups(){
        return $this->belongsToMany(AclGroup::class, 'acl_gate_groups');
    }
}
