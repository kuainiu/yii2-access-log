<?php

namespace kuainiu\accesslog\assets;

use yii\web\AssetBundle;

/**
 * CalHeatmapAsset asset bundle.
 */
class CalHeatmapAsset extends AssetBundle
{
    public $sourcePath='@kuainiu/accesslog/assets';
    public $css      = [
        'js/cal-heatmap/calendar-heatmap.css',
    ];
    public $js       = [
        'js/cal-heatmap/d3.min.js',
        'js/cal-heatmap/moment.js',
        'js/cal-heatmap/calendar-heatmap.js',
    ];
    public $depends  = [
    ];
}