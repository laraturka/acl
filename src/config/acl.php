<?php

return [

        'controllers' => [
            'AclController' => null,
            'HomeController' => null,
        ],

        'gates' => [
            'superadmin',
            'admin',
            'upload',
            'mail',
            'sms',
        ]

    ];