<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\admin\forms\PasswordRecoveryForm */

$this->title = 'Панель администратора | Восстановление пароля';
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b><?= Yii::$app->params['appName'] ?></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-box-body">
            <p>На указанную вами почту было отправлено сообщение с дальнейшими инструкциями по действию</p>
            <a href="/admin">На главную</a>
        </div>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
