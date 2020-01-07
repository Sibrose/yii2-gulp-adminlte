<?php
namespace app\modules\admin\controllers;

use app\modules\admin\components\AdminBaseController;

class CkFinderController extends AdminBaseController
{
    public function actionIndex() {
        $this->layout = null;
        return $this->render('index');
    }
}