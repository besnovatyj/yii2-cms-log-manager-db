<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

use Besnovatyj\Backend\Widgets\grid\ActionColumn;
use Besnovatyj\LogDbManager\entities\DbLog;
use Besnovatyj\LogDbManager\helpers\DbLogHelper;
use Besnovatyj\Kernel\security\AccessHelper;
use Besnovatyj\Backend\Widgets\pagination\LinkPager;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use Besnovatyj\LogDbManager\forms\backend\search\DbLogSearch;

/**
 * @var View $this
 * @var DbLogSearch $searchModel
 * @var ArrayDataProvider $dataProvider
 */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = 'Logs';
?>
<p>
    <?= Html::a('Clear log table', ['clear'], [
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
        <?= GridView::widget([
            'options' => ['class' => 'table detail-view'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{summary}\n{items}",
            'columns' => [

                [
                    'attribute' => 'id',
                    'value' => static function (DbLog $model) {
                        return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'level',
                    'filter' => $searchModel->levelsList(),
                    'value' => static function (DbLog $model) {
                        return DbLogHelper::levelName($model->level);
                    },
                ],
                [
                    'attribute' => 'category',
                    'filter' => $searchModel->categoryList(),
                    'value' => static function (DbLog $model) {
                        return $model->category;
                    },
                ],
                [
                    'attribute' => 'log_time',
                    'value' => static function (DbLog $model) {
                        $label = Yii::$app->formatter->asDateTime($model->log_time);
                        return Html::a(Html::encode($label), ['view', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'prefix',
                    'label' => 'prefix ([IP][USER_ID][SESSION])',
                    'value' => static function (DbLog $model) {
                        return $model->prefix;
                    },
                    'format' => 'raw',
                ],
                ['class' => ActionColumn::class,
                    'template' => AccessHelper::filterActionColumn(['view', 'update', 'delete',]),
                ],
            ],
        ]); ?>
    </div>
    <div class="card-footer clearfix">
        <nav aria-label="" class="nav-pagination">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->getPagination(),
            ]) ?>
        </nav>
    </div>
</div>
