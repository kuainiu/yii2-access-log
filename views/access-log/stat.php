<?php

/* @var $this yii\web\View */

/* @var $recentlyRecords array */

use kuainiu\access_log\assets\AppAsset;

$this->title                   = '访问统计';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>

<div class="col-md-8 col-md-offset-2">
    <!-- USERS LIST -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">最近一月用户访问报表排行</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <ul class="users-list">
                <?php foreach ($recentlyRecords as $model): ?>
                    <?php $profileUrl = sprintf("/%s/user/profile?id=%s", $this->context->module->id,
                        $model['access_log_user_id']); ?>
                    <li style="width:70px;height: 110px">
                        <a class="users-list-name" href="<?= $profileUrl ?>">
                            <img style="width:50px;height: 50px" src="<?= $model['avatar'] ?>">
                            <div class="users-list-name "><?= $model['access_log_user_name'] ?></div>
                        </a>
                        <span class="users-list-count "><?= $model['count'] ?></span>
                    </li>
                <?php endforeach; ?>

            </ul>
            <!-- /.users-list -->
        </div>
    </div>
    <!--/.box -->
</div>
