<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\migrations;

use Besnovatyj\Kernel\migration\BaseMigration;
use yii\base\NotSupportedException;

/** 'm<YYMMDD_HHMMSS>_<Name>' */
class m230518_141550_create_log_table extends BaseMigration
{
    public const string TABLE_NAME = '{{%log_logs}}';

    /**
     * @throws NotSupportedException
     */
    public function safeUp(): void
    {
        parent::safeUp();

        if ($this->existTable(static::TABLE_NAME)) {
            return;
        }

        $this->createTable(static::TABLE_NAME, [
            'id' => $this->bigPrimaryKey(20),
            'level' => $this->integer()
                ->comment('Уровень'),
            'category' => $this->string(255)
                ->comment('Категория'),
            'log_time' => $this->double()
                ->comment('Время'),
            'prefix' => $this->text()
                ->comment('Префикс'),
            'message' => $this->text()
                ->comment('Подробности'),
        ], $this->tableOptions);
        $this->addCommentOnTable(static::TABLE_NAME, 'Логгер');

        $this->createIndexes(static::TABLE_NAME, 'level');
        $this->createIndexes(static::TABLE_NAME, 'category');
    }

}
