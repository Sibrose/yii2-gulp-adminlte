<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Yii::$app->params['shortAppName'] . '</span><span class="logo-lg">' . Yii::$app->params['appName'] . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <?= Html::a(
                        'Выход',
                        ['/admin/index/logout'],
                        ['data-method' => 'post', 'class' => 'btn']
                    ) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
