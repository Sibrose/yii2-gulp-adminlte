<?php
use \app\models\User;
use yii\helpers\Url;

/** @var User $user */
?>

Для восстановления пароля к панели управления, пройдите по ссылке:
<?= Url::to(['/admin/password-reset', 'token' => $user->password_reset_token], true) ?>
