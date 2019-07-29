<?php

namespace kuainiu\accesslog\controllers;

use kuainiu\accesslog\models\AccessLog;
use kuainiu\accesslog\models\AccessLogSearch;
use yii\web\NotFoundHttpException;

use Yii;


/**
 * AccessLogController implements the CRUD actions for AccessLog model.
 */
class AccessLogController extends \yii\web\Controller
{
    /**
     * Lists all AccessLog models.
     *
     * @return mixed
     */
    //public $includeIndex;
    public function actionIndex()
    {
        //var_dump($this->module->includeIndex);
        $searchModel  = new AccessLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 访问统计
     *
     * @param int $limit
     *
     * @return string
     */
    public function actionStat()
    {
        $searchModel = new AccessLog();

        //$searchModel->getRecentlyRecords();
        return $this->render('stat', [
            'recentlyRecords' => $searchModel->getRecentlyRecords($this->module->includeIndex),
        ]);
    }

    /**
     * Displays a single AccessLog model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the AccessLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return AccessLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccessLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
