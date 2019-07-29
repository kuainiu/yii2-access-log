<?php
namespace kuainiu\accesslog\assets;

use yii\web\AssetBundle;

class DatetimePickerAsset extends AssetBundle
{
    public $sourcePath='@kuainiu/accesslog/assets';
    public $css     = [
        'js/datepicker/css/bootstrap-datetimepicker.min.css',
    ];
    public $js      = [
        'js/datepicker/js/bootstrap-datetimepicker.min.js',
        'js/datepicker/js/locales/bootstrap-datetimepicker.zh-CN.js',
    ];
    public $depends = [
        'kuainiu\accesslog\assets\AdminLteAsset',
    ];
}
