<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AclController extends Model
{
    protected $fillable = [
        'controller', 'method',
    ];

    public function group(){
        return $this->belongsTo(AclGroup::class);
    }

    public function scopeNotSuper($query){
        return $query->whereNotNull('method');
    }

    public function scopeSuper($query){
        return $query->whereNull('method');
    }

    public function scopeNotSuperSuper($query){
        return $query->whereNotNull('controller');//->whereNotNull('method');
    }

    public function scopeSuperSuper($query){
        return $query->whereNull('controller');//->whereNull('method');
    }
}
