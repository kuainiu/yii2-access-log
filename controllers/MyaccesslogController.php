<?php

namespace neek\acclog\controllers;

use neek\acclog\models\AccessLog;
use neek\acclog\models\AccessLogSearch;
use Yii;


/**
 * AccessLogController implements the CRUD actions for AccessLog model.
 */
class MyaccesslogController extends \yii\web\Controller
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
}
