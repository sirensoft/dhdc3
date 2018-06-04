<?php

namespace frontend\modules\ehr\controllers;

use yii\web\Controller;
use Yii;
use yii\data\ArrayDataProvider;


class DefaultController extends \common\components\AppController {
     public $enableCsrfValidation = false; //เพิ่ม
  
    public function actionIndex() {
        $this->permitRole([1,2]);// เพิ่ม
        $this->overclock();
        // connect database
        $connection = Yii::$app->db;

        $tname = '';
        $taddr = '';
        $sex = '1';
        $chronic = '';
        $cid = '';
        $seq = '';
        $hospcode = '';
        $an = '';
        $date_serv = '';
        $cc = '';
        $sbp = '';
        $dbp = '';
        $pr = '';
        $rr = '';
        $btemp = '';
        $hospname = '';
        $timeserv = '';
        $birth ='';
        
        
        if (Yii::$app->request->isPost) {
            $cid = Yii::$app->request->post('cid');
            Yii::$app->session['cid'] = $cid;
        }
        if (isset($_GET['hospcode'])) {
            $cid = Yii::$app->session['cid'];
            $seq = $_GET['seq'];
            $hospcode = $_GET['hospcode'];
            $an = $_GET['an'];
        }
	 if (isset($_GET['page'])) {
            $cid = Yii::$app->session['cid'];
        }

        // ข้อมูลบุคคล
        $sql = "SELECT p.cid,CONCAT(n.prename,p.name,' ',p.lname) AS tname,sex,
                CONCAT('เลขที่ ',h.HOUSE,' ต.',t.tambonname,' อ.',a.ampurname,' จ.',c.changwatname) AS taddr,
                CONCAT(tc.chronic,' ',i.diagename)  as chronic,birth
                FROM person p
                LEFT JOIN cprename n ON n.id_prename = p.prename
                LEFT JOIN home h ON h.HOSPCODE = p.HOSPCODE AND h.HID = p.HID
                LEFT JOIN tmp_chronic tc on tc.cid = p.cid
                LEFT JOIN cicd10tm i ON i.diagcode = tc.chronic
                LEFT JOIN campur a ON a.ampurcode = h.AMPUR AND a.changwatcode =  h.CHANGWAT
                LEFT JOIN cchangwat c  ON c.changwatcode = h.CHANGWAT
                LEFT JOIN ctambon t ON t.tamboncode = h.TAMBON AND t.ampurcode = CONCAT(c.changwatcode,a.ampurcode)
                WHERE  p.cid = '$cid' 
                LIMIT 1";

        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $tname = $data[$i]['tname'];
            $taddr = $data[$i]['taddr'];
            $sex = $data[$i]['sex'];
            $chronic = $data[$i]['chronic'];
            $birth = $data[$i]['birth'];
        }


        // ข้อมูลวันที่มารักษา
        $sqld = "SELECT CONCAT(s.date_serv,' ',left(time_serv,2),':',SUBSTR(time_serv,3,2),':',right(time_serv,2)) tdate,
                s.hospcode,s.seq,h.hosname as hospname,p.pid,
                IF(a.an IS NULL,'N','Y') AS tadmit,
                IF(a.an IS NULL,' ',a.AN) AS an
                FROM service s
                LEFT JOIN person p ON p.hospcode = s.hospcode AND p.pid =s.pid
                LEFT JOIN chospital  h ON h.hoscode = s.hospcode
		LEFT JOIN tmp_admission a ON a.HOSPCODE = s.HOSPCODE AND a.SEQ = s.SEQ
                WHERE  p.cid = '$cid'
                ORDER BY date_serv DESC";
        $rawData = $connection->createCommand($sqld)
                ->queryAll();

        $dataProvider = new ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        //วินิจฉัย
        $sqli = "SELECT d.diagcode,diagename,diagtype
                    FROM tmp_diag_opd  d
                    LEFT JOIN cicd10tm i ON i.diagcode = d.diagcode
                    WHERE cid ='$cid'
                    AND seq='$seq' AND hospcode = '$hospcode'    
                    UNION ALL
                    SELECT d.diagcode,diagename,diagtype
                    FROM diagnosis_ipd d
                    LEFT JOIN cicd10tm i ON i.diagcode = d.diagcode
                    WHERE an ='$an'  AND hospcode = '$hospcode'    ";
        $rawi = $connection->createCommand($sqli)
                ->queryAll();

        $dataProvideri = new ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawi,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);
        //อาการ
        $sqlcc = "SELECT date_serv,CHIEFCOMP,sbp,dbp,pr,rr,btemp,h.hosname,
                    CONCAT(left(time_serv,2),':',SUBSTR(time_serv,3,2),':',right(time_serv,2)) as time_serv
                    FROM service s
                    LEFT JOIN  chospital h ON h.hoscode = s.hospcode
                    WHERE s.hospcode='$hospcode' AND seq ='$seq' 
                    LIMIT 1";
        $datacc = $connection->createCommand($sqlcc)
                ->queryAll();

        for ($i = 0; $i < sizeof($datacc); $i++) {
            $date_serv = $datacc[$i]['date_serv'];
            $cc = $datacc[$i]['CHIEFCOMP'];
            $sbp = $datacc[$i]['sbp'];
            $dbp = $datacc[$i]['dbp'];
            $pr = $datacc[$i]['pr'];
            $rr = $datacc[$i]['rr'];
            $btemp = $datacc[$i]['btemp'];
            $hospname = $datacc[$i]['hosname'];
            $hospname = str_replace("โรงพยาบาลส่งเสริมสุขภาพตำบล", "รพสต.", $hospname);
            $timeserv = $datacc[$i]['time_serv'];
        }
        //LAB
        $sqll = "SELECT l.labtest, t.labtest AS tlname,labresult
                    FROM  tmp_labfu l
                    LEFT JOIN clabtest t ON t.id_labtest = l.labtest
                    WHERE cid ='$cid'
                    AND seq='$seq' AND hospcode = '$hospcode'    ";
        $rawl = $connection->createCommand($sqll)
                ->queryAll();

        $dataProviderl = new ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawl,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);

        //ยา
        $sqldr = "SELECT d.dname,d.AMOUNT
                FROM tmp_drug_opd  d 
                WHERE cid = '$cid'
                      AND HOSPCODE ='$hospcode' AND seq ='$seq' 
                UNION ALL
                SELECT d.dname,d.AMOUNT
                FROM drug_ipd  d
               
                WHERE an ='$an'  AND hospcode = '$hospcode'  ";
        $rawdr = $connection->createCommand($sqldr)
                ->queryAll();

        $dataProviderdr = new ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawdr,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);

        return $this->render('index', ['cid' => $cid, 'tname' => $tname, 'taddr' => $taddr, 'sex' => $sex, 'chronic' => $chronic,'birth'=>$birth,
                    'dataProvider' => $dataProvider,
                    'dataProvideri' => $dataProvideri,
                    'dataProviderl' => $dataProviderl,
                    'dataProviderdr' => $dataProviderdr,
                    'dateserv' => $date_serv,
                    'cc' => $cc,
                    'sbp' => $sbp,
                    'dbp' => $dbp,
                    'pr' => $pr,
                    'rr' => $rr,
                    'btemp' => $btemp,
                    'hospcode' =>$hospcode,
                    'hospname'=>$hospname,
                    'timeserv'=>$timeserv
        ]);
    }

}
