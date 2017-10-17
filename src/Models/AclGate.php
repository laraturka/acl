<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AclGate extends Model
{
    protected $fillable = ['name'];

    public function groups(){
        return $this->belongsTo(AclGroup::class );
    }

    public function scopeNotSuper($query){
        return $query->whereNotNull('name');
    }

    public function scopeSuper($query){
        return $query->whereNull('name');
    }
}
