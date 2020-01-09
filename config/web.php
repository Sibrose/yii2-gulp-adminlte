<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5fCGKZc1QirPEnalgNTo',
        ],
        'assetManager' => [
            'bundles' => [
//                'yii\bootstrap\BootstrapAsset' => false,
//                'yii\validators\ValidationAsset' => false,
//                'yii\web\YiiAsset' => false,
//                'yii\widgets\ActiveFormAsset' => false,
//                'yii\bootstrap\BootstrapPluginAsset' => false,
//                'yii\web\JqueryAsset' => false,
                //'yii\authclient\widgets\AuthChoiceAsset' => false, //authchoice.js
                //'yii\authclient\widgets\AuthChoiceStyleAsset' => false, //authchoice.css
            ],
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
        'mailService' => [
            'class' => 'app\services\MailService',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => array(
                'admin/password-recovery' => '/admin/index/password-recovery',
                'admin/password-reset' => '/admin/index/password-reset',
                'admin/login' => '/admin/index/login',
                'admin' => '/admin/index/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller\w+>/<action>/<id\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main'
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

Yii::$container->set('pavlinter\display\DisplayImage', [
    'bgColor' => 'ffffff',
    'config' => [
        'all' => [
            'imagesWebDir' => '@web',
            'imagesDir' => '@webroot',
            'defaultWebDir' => '@web/uploads',
            'defaultDir' => '@webroot/uploads',
            'defaultImage' => 'default.png',
            'mode' => \pavlinter\display\DisplayImage::MODE_STATIC,
        ],
    ]
]);

return $config;
