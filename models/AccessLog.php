<?php

namespace kuainiu\accesslog\models;

use kuainiu\accesslog\models\Dh;
use yii\base\UserException;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

/**
 * This is the model class for table "access_log".
 *
 * @property integer $access_log_id
 * @property string  $access_log_request_url
 * @property string  $access_log_request_method
 * @property string  $access_log_request_params
 * @property string  $access_log_server_ip
 * @property string  $access_log_client_ip
 * @property integer $access_log_user_id
 * @property string  $access_log_user_name
 * @property string  $access_log_access_at
 * @property string  $access_log_create_at
 * @property string  $access_log_update_at
 */
class AccessLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public static function tableName()
    {
        return 'access_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'access_log_request_url',
                    'access_log_request_method',
                    'access_log_server_ip',
                    'access_log_client_ip',
                    'access_log_user_id',
                    'access_log_user_name',
                    'access_log_access_at',
                ],
                'required',
            ],
            [['access_log_request_params'], 'string'],
            [['access_log_user_id'], 'integer'],
            [['access_log_access_at', 'access_log_create_at', 'access_log_update_at'], 'safe'],
            [['access_log_request_url', 'access_log_user_name'], 'string', 'max' => 255],
            [['access_log_request_method', 'access_log_server_ip', 'access_log_client_ip'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'access_log_id'             => '主键',
            'access_log_request_url'    => '请求地址',
            'access_log_request_method' => '请求方法',
            'access_log_request_params' => '请求参数',
            'access_log_server_ip'      => '服务器IP',
            'access_log_client_ip'      => '客户端IP',
            'access_log_user_id'        => '用户ID',
            'access_log_user_name'      => '用户名',
            'access_log_access_at'      => '访问时间',
            'access_log_create_at'      => '创建时间',
            'access_log_update_at'      => '更新时间',
        ];
    }

    /**
     * @param array $params
     *
     * @return \common\models\AccessLog
     * @throws \yii\base\UserException
     */
    public static function import($params)
    {
        $accessLog = new self();
        if (!($accessLog->load(['data' => $params], 'data') && $accessLog->save())) {
            throw new UserException(Json::encode(
                $accessLog->getErrors(),
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            ));
        }

        return $accessLog;
    }

    /**
     * 获取最近访问记录
     *
     * @param     $includeIndex
     * @param int $recentDays
     * @param int $limit
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getRecentlyRecords($includeIndex, $recentDays = 30, $limit = 80)
    {
        //判断 true为report系统，false为capital系统
        if ($includeIndex == true) {
            $records = self::find()
                ->select([
                    //'access_log_id',
                    'access_log_user_id',
                    'access_log_user_name',
                    'avatar',
                    'count' => 'count(*)',
                ])
                ->leftJoin('user', 'access_log_user_id=id')
                ->andWhere(['>=', 'access_log_access_at', Dh::subDays(Dh::todayDate(), $recentDays)])
                //->andWhere(['not like', 'access_log_request_url', '.'])
                ->andWhere(['access_log_request_url' => 'reports/index'])
                ->andWhere(['<>', 'access_log_request_params', ''])
                ->groupBy('access_log_user_id')
                ->orderBy('count DESC')
                ->limit($limit)
                ->asArray()
                ->all();
        } else {
            $records = self::find()
                ->select([
                    'access_log_user_id',
                    'access_log_user_name',
                    'avatar',
                    'count' => 'count(*)',
                ])
                ->leftJoin('user', 'access_log_user_id=id')
                ->andWhere(['>=', 'access_log_access_at', Dh::subDays(Dh::todayDate(), $recentDays)])
                ->groupBy('access_log_user_id')
                ->orderBy('count DESC')
                ->limit($limit)
                ->asArray()
                ->all();

        }
        for ($i = 0; $i < count($records); $i++) {
            $records[$i]['avatar'] = User::setDefaultAvatar($records[$i]);
        }

        return $records;
    }

    /**
     * 返回格式化后的用户按时间访问次数，时间->次数
     *
     * @param $userId
     *
     * @param $includeIndex
     *
     * @return array
     */
    public static function getAccessCountByUserId($userId, $includeIndex)
    {
        if ($includeIndex == true) {
            $data = self::find()
                ->where(['access_log_user_id' => $userId])
                //->andWhere(['not like', 'access_log_request_url', '.'])
                ->andWhere(['access_log_request_url' => 'reports/index'])
                ->andWhere(['<>', 'access_log_request_params', ''])
                ->groupBy('date(access_log_access_at)')
                ->select(['count' => 'count(*)', 'access_at' => 'date(access_log_access_at)'])
                ->asArray()
                ->all();
        } else {
            $data = self::find()
                ->where(['access_log_user_id' => $userId])
                ->groupBy('date(access_log_access_at)')
                ->select(['count' => 'count(*)', 'access_at' => 'date(access_log_access_at)'])
                ->asArray()
                ->all();
        }


        return array_column($data, 'count', 'access_at');
    }

    /**
     * @param     $userId
     * @param     $includeIndex
     * @param int $limit
     *
     * @return array|\common\models\AccessLog[]|\yii\db\ActiveRecord[]
     */
    public static function getAccessUrlCountByUserId($userId, $includeIndex, $limit = 40)
    {
        if ($includeIndex == true) {
            return self::find()
                ->leftJoin('report', 'access_log_request_params like concat("%", report_id,"%")')
                ->where(['access_log_user_id' => $userId])
                //->andWhere(['not like', 'access_log_request_url', '.'])
                ->andWhere(['access_log_request_url' => 'reports/index'])
                ->andWhere(['<>', 'access_log_request_params', ''])
                ->groupBy('full_url')
                ->orderBy('count desc')
                ->select([
                    'count'    => 'count(*)',
                    'full_url' => 'concat(access_log_request_url,"?",access_log_request_params)',
                    'report_group',
                    'report_name',
                ])
                ->asArray()
                ->limit($limit)
                ->all();
        } else {
            return self::find()
                ->select([
                    'count' => 'count(*)',
                    'access_log_request_url',
                ])
                ->where(['access_log_user_id' => $userId])
                ->groupBy('access_log_request_url')
                ->orderBy('count desc')
                ->asArray()
                ->limit($limit)
                ->all();
        }

    }
}
