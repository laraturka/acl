<?php

/*

if (! function_exists('acl')) {
    function acl()
    {
        //
    }
}

/**/


use Laraturka\Acl\Acl;

if (!function_exists('acl')) {

    function acl($source = null)
    {
        return new Laraturka\Acl\Acl();
    }
}
