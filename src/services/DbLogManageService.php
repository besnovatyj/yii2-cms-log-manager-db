<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\services;

use Besnovatyj\LogDbManager\repositories\DbLogRepository;
use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;

class DbLogManageService
{
    public DbLogRepository $logs;

    public function __construct(DbLogRepository $logs,)
    {
        $this->logs = $logs;
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function remove($id): void
    {
        $log = $this->logs->get($id);
        $this->logs->remove($log);
    }

    /**
     * @throws Exception
     */
    public function clear(): void
    {
        $this->logs->clearLogTable();
    }

}
