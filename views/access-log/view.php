<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AccessLog */

$this->title                   = $model->access_log_id;
$this->params['breadcrumbs'][] = ['label' => 'Access Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-log-view">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">基本信息</h3>
        </div>

        <?= DetailView::widget([
            'model'      => $model,
            'attributes' => [
                'access_log_id',
                'access_log_request_url:url',
                'access_log_request_method',
                'access_log_request_params:ntext',
                'access_log_server_ip',
                'access_log_client_ip',
                'access_log_user_id',
                'access_log_user_name',
                'access_log_access_at',
                'access_log_create_at',
                'access_log_update_at',
            ],
            'template'   => "<tr><th>{label}</th><td><div style =word-break:break-all width:600px>{value}</div></td></tr>",
        ]) ?>
    </div>
</div>
