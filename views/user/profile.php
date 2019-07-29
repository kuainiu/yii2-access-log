<?php

use kuainiu\access_log\assets\CalHeatmapAsset;
use kuainiu\access_log\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model \common\models\User */
/* @var $accessCount array */
/* @var $accessUrlCount array */
$this->title                   = 'User Profile';
$this->params['breadcrumbs'][] = $this->title;
CalHeatmapAsset::register($this);
AppAsset::register($this);
?>


<section class="content">

    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img style="width:100px;height: 100px" class="profile-user-img img-responsive img-circle"
                         src="<?= $model->avatar ?>">
                    <h3 class="profile-username text-center"><?= $model->fullname ?></h3>
                    <p class="text-muted text-center"><?= $model->position ?></p>
                    <p class="text-muted text-center"><?= $model->email ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div id="cal-heatmap" style="text-align: center"></div>

                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <?php foreach ($accessUrlCount as $value): ?>
                                    <li class="item">
                                        <div class="product-info">
                                            <?php
                                            if ($this->context->module->includeIndex == true) {
                                                $paramsUrl  = $value['full_url'];
                                                $paramsName = $value['report_group'] . '-' . $value['report_name'];
                                            } else {
                                                $paramsName = $value['access_log_request_url'];
                                                $paramsUrl  = $value['access_log_request_url'];
                                            }

                                            ?>
                                            <a href="/<?= $paramsUrl ?>" class="product-title">
                                                <?= $paramsName ?>
                                                <span class="label label-warning pull-right"><?= $value['count'] ?></span></a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <?php $indexUrl = sprintf('/%s/access-log/index', $this->context->module->id) ?>
                            <a href=<?= $indexUrl ?> class="uppercase" target="_blank">查看所有访问记录</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->


        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

</section>


<script type="text/javascript">
    <?php $this->beginBlock('js_import') ?>
    $(function () {
        var accessCount = <?= json_encode($accessCount);  ?>;


        var formatter = d3.time.format("%Y-%m-%d");

        var now       = moment().endOf('day').toDate();
        var yearAgo   = moment().startOf('day').subtract(1, 'year').toDate();
        var chartData = d3.time.days(yearAgo, now).map(function (dateElement) {
            var formatDate = formatter(dateElement);

            return {
                date : dateElement,
                count: accessCount[formatDate] ? parseInt(accessCount[formatDate]) : 0
            };
        });

        console.log(chartData);

        var heatmap = calendarHeatmap()
            .data(chartData)
            .selector('#cal-heatmap')
            .tooltipEnabled(true)
            .colorRange(['#f4f7f7', '#79a8a9'])
            .onClick(function (data) {
                console.log('data', data);
            });
        heatmap();  // render the chart
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['js_import'], \yii\web\View::POS_END); ?>
</script>