<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\helpers;

use Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\log\Logger;

class DbLogHelper
{
    public static function levelsList(): array
    {
        return [
            Logger::LEVEL_ERROR => 'Error',
            Logger::LEVEL_WARNING => 'Warning',
            Logger::LEVEL_INFO => 'Info',
            Logger::LEVEL_TRACE => 'Trace',
        ];
    }

    /**
     * @throws Exception
     */
    public static function levelName(int $level): string
    {
        return ArrayHelper::getValue(self::levelsList(), $level);
    }

    /**
     * @throws Exception
     */
    public static function statusLabel(int $level): string
    {
        $class = match ($level) {
            Logger::LEVEL_ERROR => 'badge badge-danger',
            Logger::LEVEL_WARNING => 'badge badge-warning',
            Logger::LEVEL_INFO => 'badge badge-info',
            Logger::LEVEL_TRACE => 'badge bg-secondary',
            default => 'badge badge-dark',
        };

        return Html::tag('span', ArrayHelper::getValue(self::levelsList(), $level), [
            'class' => $class,
        ]);
    }
}
