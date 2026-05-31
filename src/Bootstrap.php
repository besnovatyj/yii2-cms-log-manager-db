<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

declare(strict_types=1);

namespace Besnovatyj\LogDbManager;

use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\log\DbTarget;

/**
 * Bootstrap модуля LogDbManager.
 *
 * Регистрирует DIC-зависимости и слушателей событий.
 * Должен выполняться при старте приложения — указать в composer.json:
 *   "extra": { "bootstrap": "Besnovatyj\\LogDbManager\\Bootstrap" }
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @throws InvalidConfigException
     */
    public function bootstrap($app): void
    {
        $LogDbManagerTarget = \Yii::createObject([
            'class' => DbTarget::class,
            'levels' => ['error', 'warning'],
            'logTable' => '{{%log_logs}}',
        ]);

        $app->log->targets['LogDbManager'] = $LogDbManagerTarget;
    }
}
