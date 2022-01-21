<?php
return [

    'guard_name' => 'api',

    'roles' => [
        'user',
        'admin',
        'manager',
    ],

    'types' => [
        'user',
    ],

    'permissions' => [
        'view-all',
        'view-single',
        'edit',
        'update',
        'disable',
        'restore',
    ]
];
