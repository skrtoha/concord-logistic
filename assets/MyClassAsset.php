<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyClassAsset extends AssetBundle
{
    public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
    public $baseUrl = '@web';//Алиас пути к файлам
    public $css = [
        'css/bootstrap.4.1.1.min.css',
        'css/main.css?10',
        'css/v-cloak.css',
    ];
    public $js = [
        /*'js/uikit.js',
        'js/uikit-icons.js',
        'js/sweetalert.min.js',
        '/js/jquery-3.0.0.min.js',
        '/js/bootstrap.min.js',*/
        'js/vue.2.6.0.js',
        'js/axios.min.js',
    ];
    public $cssOptions = [
        'position' => View::POS_HEAD
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
}
