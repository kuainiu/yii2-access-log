<?php

namespace kuainiu\accesslog\controllers;

use kuainiu\accesslog\models\AccessLog;
use kuainiu\accesslog\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     *
     * @param $id
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionProfile($id)
    {
        $includeIndex = $this->module->includeIndex;

        return $this->render('profile', [
            'model'          => $this->findModel($id),
            'accessCount'    => AccessLog::getAccessCountByUserId($id, $includeIndex),
            'accessUrlCount' => AccessLog::getAccessUrlCountByUserId($id, $includeIndex),
        ]);
    }


    /**
     * Finds the AccessLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            $model['avatar'] = User::setDefaultAvatar($model);

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
