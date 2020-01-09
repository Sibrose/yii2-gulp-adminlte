<?php

namespace app\modules\admin\controllers;

use yii\web\Response;
use Yii;

use app\modules\admin\components\AdminBaseController;
use app\modules\admin\forms\LoginForm;
use app\modules\admin\forms\PasswordRecoveryForm;
use app\modules\admin\forms\PasswordResetForm;
use app\models\User;

/**
 * Index controller for the `admin` module
 */
class IndexController extends AdminBaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/admin');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/admin');
        }

        $model->password = '';

        $this->layout = 'main-login';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/admin/login');
    }

    public function actionPasswordRecovery()
    {
        $model = new PasswordRecoveryForm();
        $this->layout = 'main-login';

        if ($model->load(Yii::$app->request->post()) && $model->sendRecoveryMessage()) {
            return $this->render('password-recovery-success');
        }

        return $this->render('password-recovery', [
            'model' => $model
        ]);
    }

    public function actionPasswordReset($token)
    {
        $user = User::findByPasswordResetToken($token);
        $this->layout = 'main-login';

        if (!$user || !$user->isPasswordResetTokenValid()) {
            return $this->redirect('/admin/login');
        }

        $model = new PasswordResetForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->session->setFlash('password-reset', 'Пароль успешно изменен!');
            return $this->redirect('login');
        }

        return $this->render('password-reset', [
            'model' => $model
        ]);
    }
}
