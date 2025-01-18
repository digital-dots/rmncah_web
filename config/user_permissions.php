<?php

return [
    'default' => [
        [
            'name' => 'Dashboard',
            'permissions' => [
                'view_dashboard',
            ],
        ],
        [
            'name' => 'User',
            'permissions' => [
                'view_user',
                'add_user',
                'edit_user',
                'delete_user',
            ],
        ],
    ]
];
