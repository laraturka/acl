<?php
/**
 * Created by PhpStorm.
 * User: kadir
 * Date: 15/11/2016
 * Time: 20:00
 */

namespace Laraturka\Acl\Facade;

use Illuminate\Support\Facades\Facade;


class Acl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Laraturka\Acl\Acl';
    }
}