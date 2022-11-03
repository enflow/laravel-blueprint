<?php

return [
    'packs' => [
        'custom' => resource_path('img/svgs/'),
        'far' => [
            'path' => base_path('node_modules/@fortawesome/fontawesome-pro/svgs/regular/'),
            'auto_size_on_viewbox' => true,
        ],
        'fas' => [
            'path' => base_path('node_modules/@fortawesome/fontawesome-pro/svgs/solid/'),
            'auto_size_on_viewbox' => true,
        ],
    ],
    'inline_for_ajax' => true,
];
