<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

use Besnovatyj\LogDbManager\entities\DbLog;
use Besnovatyj\LogDbManager\helpers\DbLogHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this View */
/* @var $dbLog DbLog */

$dbLogDateTime = Yii::$app->formatter->asDatetime($dbLog->log_time);
$this->title = $dbLogDateTime;
$this->params['breadcrumbs'][] = ['label' => 'Db Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Delete', ['delete', 'id' => $dbLog->id], [
        'class' => 'btn  btn-danger',
        'data' => [
            'confirm' => 'Are you sure?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<div class="card">
    <div class="card-header"><?= $this->title ?></div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <?= DetailView::widget([
            'model' => $dbLog,
            'options' => ['class' => 'table detail-view'],
            'attributes' => [
                'id',
                [
                    'attribute' => 'level',
                    'value' => DbLogHelper::statusLabel($dbLog->level),
                    'format' => 'raw'
                ],
                'category',
                [
                    'attribute' => 'log_time',
                    'value' => $dbLogDateTime,
                ],
                'prefix',
                [
                    'attribute' => 'message',
                    'value' => static function (DbLog $model) {
                        return '<pre><code style="white-space: pre-wrap">' . $model->message . '</code></pre>';
                    },
                    'format' => 'raw'
                ],
            ],
        ]) ?>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">

    </div>
</div>
<!-- /.card -->
