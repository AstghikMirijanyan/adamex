<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'main/themify-icons.css',
        'main/style.css',
        'main/slicknav.min.css',
        'main/owl.carousel.min.css',
        'main/nice-select.css',
        'main/jquery-ui.min.css',
        'main/font-awesome.min.css',
        'main/elegant-icons.css',
    ];
    public $js = [
        'js/jquery-3.3.1.min.js',
        'js/imagesloaded.pkgd.min.js',
        'js/jquery.countdown.min.js',
        'js/jquery.dd.min.js',
        'js/jquery.nice-select.min.js',
        'js/jquery.slicknav.js',
        'js/jquery.zoom.min.js',
        'js/jquery-ui.min.js',
        'js/owl.carousel.min.js',

        'js/main.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
