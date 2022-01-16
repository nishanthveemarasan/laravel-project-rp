<?php

return [

    'guard_name' => 'api',

    'roles' => [
        'user',
        'admin',
        'manager',
    ],

    'permissions' => [
        'view-users',
        'view-user',
        'edit-user',
        'disable-user',
        'restore-user',
    ]
];
