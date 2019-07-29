<?php

namespace kuainiu\accesslog\models;

use kuainiu\accesslog\models\Dh;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AccessLogSearch represents the model behind the search form about `common\models\AccessLog`.
 */
class AccessLogSearch extends AccessLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_log_id', 'access_log_user_id'], 'integer'],
            [
                [
                    'access_log_request_url',
                    'access_log_request_method',
                    'access_log_request_params',
                    'access_log_server_ip',
                    'access_log_client_ip',
                    'access_log_user_name',
                    'access_log_access_at',
                    'access_log_create_at',
                    'access_log_update_at',
                ],
                'safe',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $accessStart = empty($params['access_start']) ? Dh::getTodayStart(false) :
            Dh::getDateStart($params['access_start'], false);
        $accessEnd   = empty($params['access_end']) ? Dh::getDateEnd(Dh::todayDate(), false) :
            Dh::getDateEnd($params['access_end'], false);

        $query = AccessLog::find()
            ->where(['>=', 'access_log_access_at', $accessStart])
            ->andWhere(['<', 'access_log_access_at', $accessEnd])
            ->orderBy('access_log_access_at DESC')
            ->asArray();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'like',
            'access_log_request_url',
            (!empty($this->access_log_request_url) ? $this->access_log_request_url . '%' : null),
            false,
        ]);

        return $dataProvider;
    }


}
