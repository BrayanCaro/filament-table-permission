<?php

return [
    'roles' => [
        'sync' => [
            'label' => 'Sync roles',
            'modal' => [
                'heading' => 'Sync roles',
                'actions' => [
                    'confirm' => [
                        'label' => 'Sync',
                    ],

                ],
            ],
            'field' => [
                'label' => 'Role',
            ],
            'messages' => [
                'synced' => "One user's roles was synced|[2,*] :count user's roles were synced",
            ],
        ],
    ],
];
