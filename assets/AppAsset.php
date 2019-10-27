<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/dist';
    public $css = [
        'css/main.css'
    ];
    public $js = [
        'js/main.js'
    ];
}
