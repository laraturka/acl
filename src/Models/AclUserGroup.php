<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AclUserGroup extends Pivot
{
    protected $dates = ['created_at','updated_at'];
}
