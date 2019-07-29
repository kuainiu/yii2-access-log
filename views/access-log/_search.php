<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kuainiu\access_log\assets\SearchAsset;
use kuainiu\access_log\models\Dh;

/* @var $this yii\web\View */
/* @var $model common\models\AccessLogSearch */
/* @var $form yii\widgets\ActiveForm */
SearchAsset::register($this);
?>

<div class="row wrap search-options-content access-log-search">
    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => ['class' => 'form-inline search-form'],
    ]); ?>
    <div class="col-xs-12">
        <?= $form->field($model, 'access_log_request_url', ['template' => '{input}'])
            ->textInput([
                'class'       => 'input-sm input-s form-control',
                'placeholder' => '请求地址',
            ])
            ->label(false) ?>
        <?= $form->field($model, 'access_log_access_at', ['template' => '{input}'])
            ->textInput([
                'class'            => 'input-sm input-s form-control datepicker-input',
                'placeholder'      => '开始访问时间',
                'data-date-format' => 'yyyy-mm-dd',
                'name'             => 'access_start',
                'value'            => Yii::$app->request->get('access_start', Dh::todayDate()),
            ])
            ->label(false) ?>
        <?= $form->field($model, 'access_log_access_at', ['template' => '{input}'])
            ->textInput([
                'class'            => 'input-sm input-s form-control datepicker-input',
                'placeholder'      => '截止访问时间',
                'data-date-format' => 'yyyy-mm-dd',
                'name'             => 'access_end',
                'value'            => Yii::$app->request->get('access_end', Dh::todayDate()),
            ])
            ->label(false) ?>
    </div>
    <div class="col-xs-12">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary search-btn']) ?>
        <?= Html::a('重置搜索条件', 'javascript:void(0);', ['class' => 'btn btn-sm btn-default reset-btn']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
