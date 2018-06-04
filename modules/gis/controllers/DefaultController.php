<?php

namespace modules\gis\controllers;

use yii\web\Controller;
use modules\gis\models\GisDhdcTambon;
use components\MyHelper;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * Default controller for the `mapbox` module
 */
class DefaultController extends Controller {

    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['map'],
                'rules' => [

                    [
                        //'actions' => ['map',],
                        'allow' => MyHelper::modIsOn(),
                        'roles' => ['User'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->redirect(['map']);
    }

    public function actionPointHosp() {
        $sql = "SELECT h.hoscode,h.hosname,t.lat,t.lon from geojson t
INNER  JOIN chospital_amp h  on h.hoscode = t.hcode";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $point = [];
        foreach ($raw as $value) {
            $p['type'] = 'Feature';
            $p['properties']['title'] = $value['hoscode'] . "-" . $value['hosname'];
            $p['properties']['marker-size'] = 'large';
            $p['properties']['marker-color'] = '#FF4500';
            $p['properties']['marker-symbol'] = 'hospital';
            $p['geometry']['type'] = "Point";
            $p['geometry']['coordinates'][0] = $value['lon'] * 1;
            $p['geometry']['coordinates'][1] = $value['lat'] * 1;
            $point[] = $p;
        }
        return Json::encode($point);
    }

    public function actionPointVill() {
        $amp = MyHelper::getSysConfig()->district_code;
        $sql = "SELECT * from gis_villages t WHERE t.properties like '{\"DOLACODE\":\"$amp%'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $point = [];
        foreach ($raw as $value) {
            $vill['type'] = $value['type'];
            $vill['properties'] = json_decode($value['properties']);
            $vill['geometry'] = json_decode($value['geometry']);
            $point[] = $vill;
        }
        return Json::encode($point);
    }

    public function actionPointHome() {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $sql = 'SELECT t.HOSPCODE,t.HID
,concat(t.CHANGWAT,t.AMPUR,t.TAMBON) TAMBON
,concat(t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE) VILLAGE
,CONCAT(t.HOUSE," ม.",t.VILLAGE ,"  ต.",c.tambonname) TITLE
,t.LATITUDE,t.LONGITUDE
FROM home t 
LEFT JOIN ctambon c on c.tamboncodefull = concat(t.CHANGWAT,t.AMPUR,t.TAMBON)
WHERE t.LATITUDE*1 > 0 AND t.LONGITUDE*1 > 0';
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $point = [];
        foreach ($raw as $value) {
            $home['type'] = 'Feature';
            $home['properties']['title'] = $value['TITLE'];
            $home['properties']['marker-color'] = '#0000CD';
            $home['properties']['marker-symbol'] = 'warehouse';
            $home['geometry']['type'] = 'Point';
            $home['geometry']['coordinates'][0] = $value['LONGITUDE'] * 1;
            $home['geometry']['coordinates'][1] = $value['LATITUDE'] * 1;
            $point[] = $home;
        }



        return json_encode($point);
    }

    public function actionMap() {
        MyHelper::overclock();
        $sys = MyHelper::getSysConfig();
        if ($sys) {
            $amp = $sys->district_code;
            $model = GisDhdcTambon::find()->where(['=', 'concat(PROV_CODE,AMP_CODE)', $amp])->all();
        } else {
            $model = GisDhdcTambon::find()->where(['=', 'PROV_CODE', '10'])->all();
        }

        $tambon_pol = [];
        foreach ($model as $value) {
            $tambon_pol[] = [
                'type' => 'Feature',
                'properties' => [
                    /* 'fill' => call_user_func(function()use($value) {
                      if ($value->TAM_CODE % 2 == 0)
                      return '#4169e1';
                      if ($value->TAM_CODE % 3 == 0)
                      return '#ffd700';
                      return '#00ff7f';
                      }), */
                    //'fillOpacity'=>1,
                    'title' => "ต." . $value['TAM_NAMT'],
                ],
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => json_decode($value['COORDINATES']),
                ]
            ];
        }
        $tambon_pol = json_encode($tambon_pol);

        return $this->renderPartial('map', [
                    'tambon_pol' => $tambon_pol
        ]);
    }

    public function actionPointAdl() {
        MyHelper::overclock();
        $sql = "SELECT if(t.adl_code='1b1282',1,0) BED,concat(h.HOUSE,' ม.',h.VILLAGE,' ต.',tb.tambonname) TITLE,h.LATITUDE,h.LONGITUDE FROM t_aged t 
LEFT JOIN person p ON t.HOSPCODE = p.HOSPCODE AND t.PID = p.PID
LEFT JOIN home h ON h.HOSPCODE = p.HOSPCODE AND h.HID = p.HID
LEFT JOIN ctambon tb on tb.tamboncodefull = CONCAT(h.CHANGWAT,h.AMPUR,h.TAMBON)
WHERE t.adl_code in ('1b1282','1b1281') AND p.DISCHARGE = 9";

        $raw = MyHelper::query_all($sql);

        $point = [];
        foreach ($raw as $value) {
            $home['type'] = 'Feature';
            $home['properties']['title'] = $value['TITLE'];
            $home['properties']['description'] = $value['BED'] == 1 ? 'บ้านผู้ป่วยติดเตียง' : 'บ้านผู้ป่วยติดบ้าน';
            $home['properties']['marker-color'] = $value['BED'] == 1 ? '#ff4040' : '#3b5998';
            $home['properties']['marker-symbol'] = 'disability';
            $home['geometry']['type'] = 'Point';
            $home['geometry']['coordinates'][0] = $value['LONGITUDE'] * 1;
            $home['geometry']['coordinates'][1] = $value['LATITUDE'] * 1;
            $point[] = $home;
        }



        return json_encode($point);
    }

}
