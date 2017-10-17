<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AclGroup extends Model
{
    protected $table = 'acl_groups';

    protected $dates = ['created_at','updated_at'];

    public function users(){
        return $this->belongsToMany(User::class, 'acl_user_groups');
    }

    public function controllers(){
        return $this->hasMany(AclController::class);
    }

    public function gates(){

        return $this->hasMany(AclGate::class);
        /*
        return $this->belongsToMany(
            AclGate::class,
            'acl_gate_groups'
        )->withTimestamps();
        */
    }

}
