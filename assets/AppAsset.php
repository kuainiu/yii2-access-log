<?php

namespace kuainiu\accesslog\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@kuainiu/accesslog/assets';

    //public $baseUrl = 'bootstrap';

    public $css = [];

    public $js = [];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}