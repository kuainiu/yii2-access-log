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

    public $css = [
        'bootstrap/css/bootstrap.css',
    ];

    public $js = [
        'bootstrap/js/bootstrap.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'kuainiu\accesslog\assets\AdminLteAsset'
    ];

    /**
     * 按需加载JS方法
     * @param View $view
     * @param      $js_url
     */
    public static function addScript($view, $js_url)
    {
        $view->registerJsFile($js_url, [self::className(), 'depends' => 'neek\acclog\assets\AppAsset']);
    }

    /**
     * 按需加载css方法
     * @param View $view
     * @param      $css_url
     */
    public static function addCss($view, $css_url)
    {
        $view->registerCssFile($css_url, [self::className(), 'depends' => 'neek\acclog\assets\AppAsset']);
    }
}