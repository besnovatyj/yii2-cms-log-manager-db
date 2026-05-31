<?php


/*
 * Copyright (c) 2026 Besnovatyj. Licensed under the MIT License.
 */

namespace Besnovatyj\LogDbManager\controllers\backend;

use Besnovatyj\LogDbManager\entities\DbLog;
use Besnovatyj\LogDbManager\forms\backend\search\DbLogSearch;
use Besnovatyj\LogDbManager\services\DbLogManageService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class DefaultController extends Controller
{
    private DbLogManageService $service;

    public function __construct($id, $module, DbLogManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'clear' => ['POST'],
                ],
            ],
        ]);
    }

    public function actionIndex(): string
    {
        $searchModel = new DbLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'dbLog' => $this->findModel($id),
        ]);
    }

    public function actionDelete(int $id): Response
    {
        try {
            $this->service->remove($id);
        } catch (StaleObjectException | Throwable $e) {
            Yii::$app->errorHandler->logException($e);
            if (YII_DEBUG) {
                Yii::$app->session->setFlash('error', VarDumper::dumpAsString($e->getMessage()));
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->redirect(['index']);
    }

    public function actionClear(): Response
    {
        try {
            $this->service->clear();
        } catch (Exception $e) {
            Yii::$app->errorHandler->logException($e);
            if (YII_DEBUG) {
                Yii::$app->session->setFlash('error', VarDumper::dumpAsString($e->getMessage()));
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return DbLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): DbLog
    {
        if (($model = DbLog::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
