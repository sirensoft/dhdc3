<?php

namespace modules\population\controllers;

use yii\web\Controller;
use components\MyHelper;
use yii\data\ArrayDataProvider;
use common\models\config\SysConfigMain;
use modules\gis\models\GisDhdcTambon;

/**
 * Default controller for the `population` module
 */
class DefaultController extends Controller {

    public function actionJsonTambon() {
       $sql = "  SELECT t.tamboncodefull TAM_CODE,t.tambonname TAM_NAME,g.COORDINATES,COUNT(p.CID) POP
from ctambon t
INNER JOIN sys_config_main s ON s.district_code = LEFT(t.tamboncodefull,4)
INNER JOIN gis_dhdc_tambon g ON CONCAT(g.PROV_CODE,g.AMP_CODE,g.TAM_CODE) = t.tamboncodefull
INNER JOIN t_person_cid p ON LEFT(p.vhid,6) = t.tamboncodefull
WHERE   p.typearea in (1,3,5) AND p.DISCHARGE = 9
GROUP BY t.tamboncodefull ";
       $raw = MyHelper::query_all($sql);
       
        foreach ($raw as $value) {
            $tambon_pol[] = [
                'type' => 'Feature',
                'properties' => [                   
                    'TAM_NAME' =>$value['TAM_NAME'],
                    'POP'=>$value['POP']*1
                ],
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => json_decode($value['COORDINATES']),
                ]
            ];
        }
        return json_encode($tambon_pol);
    }

    public function actionMap() {

        return $this->renderPartial('map');
    }

    public function actionTypearea() {
        $sql = " SELECT  t.HOSPCODE,h.hosname HOSNAME
,SUM(if(t.TYPEAREA =1,1,0)) TYPE1
,SUM(if(t.TYPEAREA =2,1,0)) TYPE2
,SUM(if(t.TYPEAREA =3,1,0)) TYPE3
,SUM(if(t.TYPEAREA =4,1,0)) TYPE4
,SUM(if(t.TYPEAREA =5,1,0)) TYPE5
,SUM(if(t.TYPEAREA NOT IN (1,2,3,4,5),1,0)) NONTYPE
FROM  t_person_cid  t LEFT JOIN chospital_amp h on t.HOSPCODE = h.hoscode
WHERE t.DISCHARGE = 9
GROUP BY t.HOSPCODE ";
        $raw = MyHelper::query_all($sql);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $raw,
            'pagination' => [
                'pageSize' => 60
            ]
        ]);
        return $this->render('typearea', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionIndex($hospcode = null) {

        if (empty($hospcode)) {
            $sql5 = " SELECT  t.AGE_GROUP_ID,t.AGE_GROUP,SUM(t.MALE) MALE,SUM(t.FEMALE) FEMALE ,SUM(t.TOTAL) TOTAL  
FROM dhdc_population_age_group5 t GROUP BY t.AGE_GROUP_ID ";

            $sql = " SELECT  t.AGE_GROUP_ID,t.AGE_GROUP,SUM(t.MALE) MALE,SUM(t.FEMALE) FEMALE ,SUM(t.TOTAL) TOTAL  
FROM dhdc_population_age_group t GROUP BY t.AGE_GROUP_ID ";
        } else {
            $sql5 = " SELECT * FROM dhdc_population_age_group5 where HOSPCODE = $hospcode";

            $sql = " SELECT * FROM dhdc_population_age_group where HOSPCODE = $hospcode";
        }
        $raw5 = MyHelper::query_all($sql5);
        $raw = MyHelper::query_all($sql);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $raw,
            'pagination' => [
                'pageSize' => 101
            ]
        ]);

        return $this->render('index', [
                    'hospcode' => $hospcode,
                    'raw5' => $raw5,
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionGenData() {
        $this->genData5();
        $this->genData();
    }

    protected function genData() {
        $sql = " DROP TABLE IF EXISTS `dhdc_population_age_group`;";
        $sql .= "\r\n\r\n CREATE TABLE `dhdc_population_age_group` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `AGE_GROUP_ID` int(11) NOT NULL,
  `AGE_GROUP` varchar(255) DEFAULT '',
  `MALE` decimal(23,0) DEFAULT NULL,
  `FEMALE` decimal(23,0) DEFAULT NULL,
  `TOTAL` decimal(23,0) DEFAULT NULL,
  PRIMARY KEY (`HOSPCODE`,`AGE_GROUP_ID`)
) DEFAULT CHARSET=utf8;";


        $sql.="\r\n\r\n TRUNCATE dhdc_population_age_group;";



        for ($i = 0; $i <= 99; $i++) {
            $n = $i + 1;
            $sql .= "\r\n\r\n REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,$i AGE_GROUP_ID
,'$i-$n' AGE_GROUP
,SUM(if(t.age_y>=$i AND t.age_y <$n AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=$i AND t.age_y <$n AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=$i AND t.age_y <$n,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;";
        }// end loop
        //100+
        $sql .= "\r\n\r\n REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,100 AGE_GROUP_ID
,'100up' AGE_GROUP
,SUM(if(t.age_y>=100 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=100 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=100,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;";




        if (MyHelper::createProc('dhdc_module_pop_cal_age', $sql)) {
            MyHelper::exec_sql('CALL dhdc_module_pop_cal_age');
            return 'OK';
        }
    }

    protected function genData5() {
        $sql = " DROP TABLE IF EXISTS `dhdc_population_age_group5`;";
        $sql .= "\r\n\r\n CREATE TABLE `dhdc_population_age_group5` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `AGE_GROUP_ID` int(11) NOT NULL,
  `AGE_GROUP` varchar(255) DEFAULT '',
  `MALE` decimal(23,0) DEFAULT NULL,
  `FEMALE` decimal(23,0) DEFAULT NULL,
  `TOTAL` decimal(23,0) DEFAULT NULL,
  PRIMARY KEY (`HOSPCODE`,`AGE_GROUP_ID`)
) DEFAULT CHARSET=utf8;";


        $sql.="\r\n\r\n TRUNCATE dhdc_population_age_group5;";



        for ($i = 0; $i <= 99; $i+=5) {
            $n = $i + 5;
            $sql .= "\r\n\r\n REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,$i AGE_GROUP_ID
,'$i-$n' AGE_GROUP
,SUM(if(t.age_y>=$i AND t.age_y <$n AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=$i AND t.age_y <$n AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=$i AND t.age_y <$n,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;";
        }// end loop
        //100+
        $sql .= "\r\n\r\n REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,100 AGE_GROUP_ID
,'100up' AGE_GROUP
,SUM(if(t.age_y>=100 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=100 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=100,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;";




        if (MyHelper::createProc('dhdc_module_pop_cal_age5', $sql)) {
            MyHelper::exec_sql('CALL dhdc_module_pop_cal_age5');
            return 'OK';
        }
    }

}
