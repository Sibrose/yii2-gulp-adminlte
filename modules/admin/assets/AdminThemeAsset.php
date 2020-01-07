<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class AdminThemeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    public $css = [
        'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
    ];
    public $js = [
        'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        'bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ru.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}