<?php

namespace frontend\modules\test\controllers;

use yii\web\Controller;

/**
 * Default controller for the `test` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionGeo(){
        return $this->renderPartial('geo');
    }
    public function actionGrid(){
        return $this->render('grid');
    }
}
