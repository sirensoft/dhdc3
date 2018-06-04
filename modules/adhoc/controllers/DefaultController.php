<?php

namespace modules\adhoc\controllers;

use yii\web\Controller;


/**
 * Default controller for the `adhoc` module
 */
class DefaultController extends Controller
{
    
    public function actionIndex()
    {
        return $this->redirect(['dhdc-adhoc/index']);
    }
}
