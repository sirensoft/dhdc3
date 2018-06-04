<?php

namespace modules\correct\controllers;

use yii\web\Controller;
use yii\helpers\Json;

/**
 * Default controller for the `correct` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionGetData() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = [
            'a' => 1,
            'b' => 2
        ];
        return Json::encode($data);
    }

}
