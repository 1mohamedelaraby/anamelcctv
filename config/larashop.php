<?php

return [
    # Url settings
    'frontend_prefix' => 'store',
    'backend_prefix' => 'admin/shop',
    'admin_middleware' => 'auth:admin',

    # Images settings
    'thumbnails' => [
        'category' => [
            'width' => 300,
            'height' => 300
        ],

        'product' => [
            'width' => 300,
            'height' => 300
        ],
    ],

    'medium_images' => [
        'category' => [
            'width' => 600,
            'height' => 600
        ],

        'product' => [
            'width' => 600,
            'height' => 600
        ],
    ],
];
