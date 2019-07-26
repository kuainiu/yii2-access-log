<?php
namespace neek\acclog\assets;

use yii\web\AssetBundle;

class DatetimePickerAsset extends AssetBundle
{
    public $sourcePath='@neek/acclog/assets';
    public $css     = [
        'js/datepicker/css/bootstrap-datetimepicker.min.css',
    ];
    public $js      = [
        'js/datepicker/js/bootstrap-datetimepicker.min.js',
        'js/datepicker/js/locales/bootstrap-datetimepicker.zh-CN.js',
    ];
    public $depends = [
        'neek\acclog\assets\AdminLteAsset',
    ];
}
