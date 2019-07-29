<?php

namespace kuainiu\accesslog\models;

use kuainiu\accesslog\models\AccessLog;
use kuainiu\accesslog\models\Dh;
use Exception;
use Yii;

class LogHelper
{
    /**
     *  添加访问日志
     */
    public static function addAccess()
    {
        //脚本执行定时任务和未登陆用全都不记录日志
        if (Yii::$app->request->isConsoleRequest || !isset(Yii::$app->user) || Yii::$app->user->isGuest) {
            return true;
        }

        try {
            $requestUrl = Yii::$app->request->pathInfo;
            $requestUrl = empty($requestUrl) ? Yii::$app->request->url : $requestUrl;
            AccessLog::import([
                'access_log_request_url'    => $requestUrl,
                'access_log_request_method' => Yii::$app->request->method,
                'access_log_request_params' => self::getRequestParams(),
                'access_log_server_ip'      => $_SERVER['SERVER_ADDR'],
                'access_log_client_ip'      => Yii::$app->request->userIP,
                'access_log_user_id'        => Yii::$app->user->identity->id,
                'access_log_user_name'      => Yii::$app->user->identity->fullname,
                'access_log_access_at'      => Dh::getcurrentDateTime(),
            ]);
        } catch (Exception $exception) {
            $errorMsg = $exception->getMessage() . $exception->getTraceAsString();
            Yii::error($errorMsg, 'access_log');
        }

        return true;
    }

    private static function getRequestParams()
    {
        if (Yii::$app->request->method === 'GET'
            || Yii::$app->request->method === 'DELETE'
        ) {
            return $_SERVER['QUERY_STRING'];
        }
        parse_str(Yii::$app->request->rawBody, $params);
        unset($params['LoginForm']['password']);
        unset($params['ResetPasswordForm']['password']);
        unset($params['SignupForm']['password']);

        return http_build_query($params);
    }
}
