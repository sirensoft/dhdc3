<?php

namespace frontend\modules\qc\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use frontend\modules\import\models\SysFiles;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use components\MyHelper;

/**
 * Default controller for the `qc` module
 */
class DefaultController extends Controller {

    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['data-error'],
                'rules' => [

                    [
                        'actions' => ['data-error',],
                        'allow' => true,
                        'roles' => ['User'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $query = SysFiles::find()->where(['note1' => 'y']);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 6
        ]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pages,
        ]);
    }

    public function actionHosSumError($byear = NULL) {
        if (empty($byear)) {
            $sql = "SELECT t.HOSPCODE,h.hosname as 'HOSPNAME' ,t.TOTAL,t.ERR,t.QC from chospital_amp h 
                RIGHT JOIN (
		SELECT t.HOSPCODE
		,SUM(t.TOTAL)  as 'TOTAL'
		,SUM(t.ERR) as 'ERR'
		,100-ROUND(SUM(t.ERR)*100/SUM(t.TOTAL),2) as 'QC'
		FROM err_zhos t GROUP BY t.HOSPCODE
                ) t on t.HOSPCODE = h.hoscode ";
        } else {
            $sql = "SELECT t.HOSPCODE,h.hosname as 'HOSPNAME' ,t.TOTAL,t.ERR,t.QC from chospital_amp h 
                RIGHT JOIN (
		SELECT t.HOSPCODE
		,SUM(t.TOTAL)  as 'TOTAL'
		,SUM(t.ERR+t.ERR_DATE) as 'ERR'
		,100-ROUND(SUM(t.ERR+t.ERR_DATE)*100/SUM(t.TOTAL),2) as 'QC'
		FROM err_zall t WHERE t.BYEAR = '$byear'  GROUP BY t.HOSPCODE
                ) t on t.HOSPCODE = h.hoscode ";
        }


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('hos-sum-error', [
                    'dataProvider' => $dataProvider,
                    'byear' => $byear
        ]);
    }

    public function actionDataError($filename = NULL, $hospcode = NULL, $from = NULL) {
        if (!MyHelper::user_can('Pm')) {
             $hospcode = MyHelper::getUserHoscode(\Yii::$app->user->id);
        }
      

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        if (empty($filename)) {
            return $this->redirect(['index']);
        }
        $file = strtolower($filename);
        $sql = "select * from err_$file order by ERR_DATE DESC,BYEAR DESC";

        $pagination = ['pageSize' => 15];

        if (!empty($hospcode)) {
            $sql = "select * from err_$file where hospcode='$hospcode' order by ERR_DATE DESC,BYEAR DESC";
        }


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => $pagination,
        ]);
        return $this->render('data-error', [
                    'filename' => $filename,
                    'dataProvider' => $dataProvider,
                    'hospcode' => $hospcode,
                    'from' => $from
        ]);
    }

    public function actionHosFile($hospcode, $byear = NULL) {
        if (empty($byear)) {
            $sql = "SELECT t.HOSPCODE,t.FILE,t.TOTAL,t.ERR,100 - ROUND(t.ERR*100/t.TOTAL,2) as 'QC'  
         FROM err_zhos t where  t.HOSPCODE = '$hospcode' ";
        } else {
            $sql = "SELECT t.HOSPCODE,t.FILE,t.TOTAL,(t.ERR+t.ERR_DATE) as ERR,100 - ROUND((t.ERR+t.ERR_DATE)*100/t.TOTAL,2) as 'QC'  
         FROM err_zall t where  t.HOSPCODE = '$hospcode' AND t.BYEAR = '$byear' ";
        }


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('hos-file', [
                    'dataProvider' => $dataProvider,
                    'hospcode' => $hospcode,
                    'byear' => $byear
        ]);
    }

}
