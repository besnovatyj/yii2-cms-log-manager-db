<?php

/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

return [
    // DB Logs
    [
        'label' => 'DB Logs',
        'iconClass' => 'bi bi-database-exclamation me-1',
        'url' => ['/LogDbManager/backend/default/index'],
        'active' => static function () {
            return str_contains(\Yii::$app->request->url, 'LogDbManager');
        },
        '_meta' => [
            'placements' => [
//                [
//                    'location' => 'left-sidebar',
//                    'group' => 'Logs',
//                    'groupIcon' => 'bi bi-clock-history',
//                    'priority' => 100,
//                    'groupPriority' => 100,
//                ],
                [
                    'location' => 'right-sidebar',
                    'group' => 'Logs',
                    'groupIcon' => 'bi bi-clock-history',
                    'priority' => 100,
                    'groupPriority' => 100,
                ],
            ],
        ],
    ],
];
