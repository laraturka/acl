<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AclGate extends Model
{
    public function groups(){
        return $this->belongsToMany(AclGroup::class, 'acl_gate_groups');
    }

    public function scopeNotSuper($query){
        return $query->whereNotNull('name');
    }

    public function scopeSuper($query){
        return $query->whereNull('name');
    }
}
