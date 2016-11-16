<?php

namespace Laraturka\Acl;

use Illuminate\Auth\Access\HandlesAuthorization;

class AclPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->checkIfGateAuthorized($ability);
    }
}