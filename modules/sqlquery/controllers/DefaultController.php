<?php

namespace modules\sqlquery\controllers;

use yii\web\Controller;


/**
 * Default controller for the `sqlquery` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    
    public function actionIndex()
    {
        return $this->redirect(['runquery/index']);
    }
}
