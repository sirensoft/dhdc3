<?php

namespace modules\adhoc\controllers;

use Yii;
use modules\adhoc\models\Transform;
use modules\adhoc\models\TransformSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use components\MyHelper;

/**
 * TransformController implements the CRUD actions for Transform model.
 */
class TransformController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [

                    [

                        'allow' => MyHelper::modIsOn(),
                        'roles' => ['Admin'],
                    ],
                ],
            ],
        ];
    }

    protected function init_transform() {
        
        $model = Transform::find()->all();
        MyHelper::exec_sql("DROP PROCEDURE IF EXISTS dhdc_adhoc_transform;");
        $command = "CREATE PROCEDURE dhdc_adhoc_transform()\r\n ";
        $command.= "BEGIN\r\n";
        foreach ($model as $t) {
            if(substr($t->sql, -1)==';'){
                $command.= $t->sql."\r\n";
            }else{
                $command.= $t->sql.";\r\n";
            }
        }
        

        
        $command.= "\r\nEND";
        MyHelper::exec_sql($command);
    }

    /**
     * Lists all Transform models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TransformSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transform model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Transform();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->init_transform();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transform model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->init_transform();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transform model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transform model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transform the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Transform::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
