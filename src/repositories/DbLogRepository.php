<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\repositories;

use Besnovatyj\LogDbManager\entities\DbLog;
use RuntimeException;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;

class DbLogRepository
{
    public function get($id): DbLog
    {
        if (!$post = DbLog::findOne($id)) {
            throw new NotFoundException('Log item is not found.');
        }
        return $post;
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function remove(DbLog $post): void
    {
        if (!$post->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }

    /**
     * @throws Exception
     */
    public function clearLogTable(): int
    {
        return Yii::$app->db->createCommand()->truncateTable(DbLog::tableName())->execute();
    }

    public function getSizeDbTable(): int
    {
        return (int)DbLog::find()->count();
    }

}
