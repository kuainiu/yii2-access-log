<?php
namespace kuainiu\accesslog\assets;

use yii\web\AssetBundle;

class SearchAsset extends AssetBundle
{
    public $sourcePath='@kuainiu/accesslog/assets';
    public $css     = [
        'css/common-search.css',
    ];
    public $js      = [
        'js/common-search.js',
    ];
    public $depends = [
        'kuainiu\accesslog\assets\DatetimePickerAsset',
    ];
}
