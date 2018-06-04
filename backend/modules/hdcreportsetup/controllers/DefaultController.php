<?php

namespace backend\modules\hdcreportsetup\controllers;

use yii\web\Controller;

/**
 * Default controller for the `hdcreportsetup` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['hdcsql/index']);
    }
}
