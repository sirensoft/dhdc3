<?php

namespace frontend\modules\import\controllers;

use Yii;
use yii\data\ArrayDataProvider;

class CountFileController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    protected function call($store_name, $arg = NULL) {
        $sql = "";
        if ($arg != NULL) {
            $sql = "call " . $store_name . "(" . $arg . ");";
        } else {
            $sql = "call " . $store_name . "();";
        }
        return $this->query_all($sql);
    }

    protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    protected function query_all($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        return $rawData;
    }

    public function actionIndex($tb='service',$b_year='2561') {
        //$post = Yii::$app->request->post();
        //$year = date('m') >= 10 ? date('Y') + 544 : date('Y') + 543;

        //$tb = !empty($post['tb']) ? $post['tb'] : 'service';
        //$b_year = !empty($post['b_year']) ? $post['b_year'] : $year;
        
        $sql = " SELECT h.hoscode,h.hosname,t.* FROM chospital_amp h  
LEFT JOIN sys_dhdc_count_file t ON h.hoscode = t.hospcode
AND t.b_year = '$b_year' AND  t.tb = '$tb' ";
        
        $rawData = $this->query_all($sql);
        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => false
        ]);
        
        $sql_last = "SELECT max(t.date_process) lat_process FROM sys_dhdc_count_file t 
WHERE t.tb ='$tb' AND t.b_year ='$b_year'
GROUP BY t.tb,t.b_year";
        $last_process = Yii::$app->db->createCommand($sql_last)->queryScalar();
        
        return $this->render('index', [
                    'b_year' => $b_year,
                    'tb' => $tb,
                    'dataProvider'=>$dataProvider,
                    'last_process'=>$last_process
        ]);
    }

}
