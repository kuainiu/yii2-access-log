<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccessLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '访问记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-log-index">
    <section class="panel panel-default section-search">
        <header class="panel-heading search-options">搜索条件
            <i class="fa fa-arrow-circle-down text-danger"></i>
        </header>
        <div class="panel-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider'   => $dataProvider,
                'columns'        => [
                    [
                        'class'          => 'yii\grid\ActionColumn',
                        'template'       => '{view}',
                        'header'         => '操作',
                        'headerOptions'  => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttons'        => [
                            'view' => function ($url, $model, $key) {
                                $options = [
                                    'class'   => 'btn text-sm text-default fa fa-eye',
                                    'target'  => '_blank',
                                    'data-id' => $key,
                                ];

                                return Html::a('查看', $url, $options);
                            },
                        ],
                    ],
                    'access_log_request_url',
                    'access_log_request_method',
                    'access_log_server_ip',
                    'access_log_client_ip',
                    'access_log_user_name',
                    'access_log_access_at',
                    'access_log_create_at',
                ],
                'layout'         => "{items}\n{summary}",
                'summaryOptions' => [
                    'class' => 'summary',
                    'style' => 'margin-left:10px;',
                ],
                'options'        => ['style' => 'overflow-x: scroll;',],
                'tableOptions'   => [
                    'class' => 'table table-hover table-bordered',
                    'style' => 'min-width:100%',
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= LinkPager::widget([
                'pagination'     => $dataProvider->pagination,
                'nextPageLabel'  => '下一页',
                'prevPageLabel'  => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel'  => '末页',
                'options'        => [
                    'class' => 'pagination pagination-sm m-t-none m-b-none',
                ],
            ]) ?>
        </div>
    </section>
</div>
