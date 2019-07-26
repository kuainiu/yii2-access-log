<?php
namespace neek\acclog\assets;

use yii\web\AssetBundle;

class SearchAsset extends AssetBundle
{
    public $sourcePath='@neek/acclog/assets';
    public $css     = [
        'css/common-search.css',
    ];
    public $js      = [
        'js/common-search.js',
    ];
    public $depends = [
        'neek\acclog\assets\DatetimePickerAsset',
    ];
}
