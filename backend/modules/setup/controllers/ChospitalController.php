<?php

namespace backend\modules\setup\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\config\ChospitalAmp;

class ChospitalController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionUpdate($hoscode) {
        $model = ChospitalAmp::findOne($hoscode);
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if ($model->save(FALSE)) {
                \Yii::$app->session->setFlash('success', 'บันทึกสำเร็จ!');
            } else {
                \Yii::$app->session->setFlash('danger', 'บันทึกไม่สำเร็จ!');
            }
            return $this->redirect(['/setup/default/index']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($hoscode) {

        $model = ChospitalAmp::findOne($hoscode);
        if ($model->delete()) {
            \Yii::$app->session->setFlash('success', 'ลบสำเร็จ!');
        } else {
            \Yii::$app->session->setFlash('danger', 'ลบไม่สำเร็จ!');
        }
        return $this->redirect(['/setup/default/index']);
    }

    public function actionCreate() {
        $model = new ChospitalAmp();
        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'บันทึกสำเร็จ!');
            } else {
                \Yii::$app->session->setFlash('danger', 'บันทึกไม่สำเร็จ!');
            }
            return $this->redirect(['/setup/default/index']);
        }
        return $this->renderAjax('create', [
                    'model' => $model
        ]);
    }

}
