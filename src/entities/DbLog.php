<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\entities;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $level
 * @property string $category
 * @property double $log_time
 * @property string $prefix
 * @property string $message
 */
class DbLog extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%log_logs}}';
    }
}
