<?php

use Site\Distribution\Middleware\FaviconMiddleware;

return [
    'frontend' => [
        'site-distribution/favicon' => [
            'target' => FaviconMiddleware::class,
            'before' => [
                'typo3/cms-frontend/page-resolver',
            ],
            'after' => [
                'typo3/cms-frontend/site',
            ],
        ],
    ],
];
