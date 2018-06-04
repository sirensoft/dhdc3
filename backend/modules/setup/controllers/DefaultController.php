<?php

namespace backend\modules\setup\controllers;

use yii\web\Controller;
use common\models\config\SysConfigMain;
use common\models\config\Campur;
use components\MyHelper;
use yii\filters\AccessControl;

/**
 * Default controller for the `setup` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        //'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
        $model = SysConfigMain::find()->one();
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            $amp = Campur::find()->where(['ampurcodefull' => $model->district_code])->one();
            if ($amp) {
                $model->provcode = $amp->changwatcode;
                $model->distcode = $amp->ampurcode;
                $model->district_name = $amp->ampurname;
                $model->save(FALSE);
                \Yii::$app->session->setFlash('success','ตั้งค่าสำเร็จ');
                MyHelper::exec_sql("CALL z_set_chospital_amp");
                return $this->redirect(['index', 'model' => $model]);
            }else{
                \Yii::$app->session->setFlash('danger','ไม่พบอำเภอที่ระบุ');
                return $this->redirect(['index', 'model' => $model]);
            }
        }
        return $this->render('index', [
                    'model' => $model
        ]);
    }

}
