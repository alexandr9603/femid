<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fontello.css',
        'css/style.css',
        'css/jquery.mCustomScrollbar.css',
    ];
    public $js = [
         'js/vendor/jquery-1.11.3.min.js',
         'js/vendor/modernizr-2.8.3.min.js',
         'js/vendor/jquery.mCustomScrollbar.concat.min.js',
         'js/script.js',
         'js/alerts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}
