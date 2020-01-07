<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets';
    public $css = [
        'css/interface.css'
    ];
    public $js = [
        'ckfinder/ckfinder.js', // Файловый менеджер
        'js/main.js',
    ];
    public $depends = [
        'app\modules\admin\assets\AdminThemeAsset',
//        'dosamigos\ckeditor\CKEditorAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true
    ];
}