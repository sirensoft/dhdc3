<?php

namespace modules\qrcode\controllers;

use yii\web\Controller;
use yii\helpers\Json;
use components\MyHelper;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;

/**
 * Default controller for the `qrcode` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionReport($tambon, $village, $house = NULL) {
        $this->layout = 'hdc';

        $sql = " SELECT t.tambonname FROM ctambon t  WHERE t.tamboncodefull = '$tambon' ";
        $tambonname = MyHelper::query_one($sql);

        $sql = " SELECT count(t.HOSPCODE) total FROM home t
WHERE CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON) = '$tambon'
AND t.VILLAGE = '$village' ";
        if (!empty($house)) {
            $sql.= " and t.HOUSE = trim('$house')";
        }
        $count = MyHelper::query_one($sql);
        $pages = new Pagination([
            'totalCount' => $count['total'] * 1,
            'pageSize' => 12
        ]);

        $sql = " SELECT CONCAT(t.HOSPCODE,t.HID) HID,t.HOUSE_ID
,CONCAT(t.HOUSE,' หมู่ ',t.VILLAGE) ADDR FROM home t
WHERE CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON) = '$tambon' AND t.VILLAGE = '$village' ";
        if(!empty($house)){
           $sql.= " and t.HOUSE = trim('$house')"; 
        }
        $sql.= " LIMIT $pages->limit OFFSET $pages->offset ";
        $raw = MyHelper::query_all($sql);
        return $this->render('report', [
                    'raw' => $raw,
                    'tambon' => $tambon,
                    'tambonname' => $tambonname,
                    'village' => $village,
                    'pages' => $pages,
                    'sql' => $sql
        ]);
    }

    public function actionGetVillage() {
        $parents = \Yii::$app->request->post('depdrop_parents');
        if ($parents) {
            $tambon = $parents[0];
            $sql = " SELECT t.VILLAGE id,CONCAT('หมู่ ',t.VILLAGE) 'name'  FROM home t 
WHERE CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON) = '$tambon'
GROUP BY t.VILLAGE ";
            $raw = MyHelper::query_all($sql);
            $out = [];
            foreach ($raw as $val) {
                $out[] = [
                    'id' => $val['id'],
                    'name' => $val['name']
                ];
            }
            //$out[]=['id'=>'01','name'=>'A'];
            return Json::encode(['output' => $out, 'selected' => '']);
        }
    }

}
