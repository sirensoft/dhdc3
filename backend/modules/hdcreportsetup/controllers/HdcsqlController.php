<?php

namespace backend\modules\hdcreportsetup\controllers;

use Yii;
use frontend\modules\hdc\models\Hdcsql;
use frontend\modules\hdc\models\HdcsqlSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use components\MyHelper;
use yii\filters\AccessControl;


class HdcsqlController extends Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            
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

        $this->layout = 'hdc';
        $searchModel = new HdcsqlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hdcsql model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $this->layout = 'hdc';
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Hdcsql model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
       
        //$this->identify_key();

        $this->layout = 'hdc';
        $model = new Hdcsql();



        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $req = \Yii::$app->request;
            $post = $req->post();

            $cat_id = $post['cat_id'];
            $new_id = $post['Hdcsql']['rpt_id'];
            $report_name = $post['Hdcsql']['rpt_name'];

            $sql = " REPLACE INTO sys_report_dhdc (cat_id,id,report_name) VALUES  
                     ('$cat_id','$new_id' , '$report_name') ";
            MyHelper::exec_sql($sql);
            
            $sql = "DELETE FROM sys_report_drop WHERE id ='$new_id'";
            MyHelper::exec_sql($sql);



            return $this->redirect(['view', 'id' => $new_id]);
        } else {
            return $this->render('create', [

                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        
        $this->layout = 'hdc';


        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $req = \Yii::$app->request;
            $post = $req->post();

            $cat_id = $post['cat_id'];
            $new_id = $post['Hdcsql']['rpt_id'];
            $report_name = $post['Hdcsql']['rpt_name'];

            $sql = " UPDATE sys_report_dhdc t set t.cat_id = '$cat_id'
                    ,t.id = '$new_id' , t.report_name = '$report_name'
                    WHERE t.id = '$id'; ";
            MyHelper::exec_sql($sql);

            return $this->redirect(['view', 'id' => $new_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        

        $this->findModel($id)->delete();
        $sql = " delete from sys_report_dhdc where id='$id'";
        MyHelper::exec_sql($sql);
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Hdcsql::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExport($id = NULL) {
        ini_set('max_execution_time', 5 * 60);


        $con_db = \Yii::$app->db;

        $sql = " select * from hdc_rpt_sql where rpt_id ='$id'";

        $raw = $con_db->createCommand($sql)->queryAll();
        $cols = array_keys($raw[0]);



        $insert_val = '';
        foreach ($cols as $value) {
            if (empty($raw[0][$value]) or trim($raw[0][$value]) == '') {
                $val = "NULL,";
            } else {
                //$val = "'" . mysql_escape_string($raw[0][$value]) . "',";
                $val = \Yii::$app->db->quoteValue($raw[0][$value]) . ",";
            }
            $insert_val.=$val;
        }

        $cols = implode(",", $cols);
        $cols = "($cols)";
        $insert_val = rtrim($insert_val, ",");
        $insert_val = "( $insert_val )";

        $full1 = "SET NAMES 'utf8' COLLATE 'utf8_general_ci';\r\n";
        $full1.= "REPLACE INTO hdc_rpt_sql $cols VALUES $insert_val;\r\n";
        //echo $full;
//////////////


        $sql = " select * from sys_report_dhdc where id ='$id'";

        $raw = $con_db->createCommand($sql)->queryAll();
        $cols = array_keys($raw[0]);



        $insert_val = '';
        foreach ($cols as $value) {

            if (empty($raw[0][$value]) or trim($raw[0][$value]) == '') {
                $val = "'',";
            } else {
                //$val = "'" . mysql_escape_string($raw[0][$value]) . "',";
                $val = \Yii::$app->db->quoteValue($raw[0][$value]) . ",";
            }
            $insert_val.=$val;
        }

        $cols = implode(",", $cols);
        $cols = "($cols)";
        $insert_val = rtrim($insert_val, ",");
        $insert_val = "( $insert_val )";

        $full2 = "DELETE FROM sys_report_dhdc WHERE id = '$id';\r\n";
        $full2.= "DELETE FROM sys_report_drop WHERE id = '$id';\r\n";
        $full2.= "REPLACE INTO sys_report_dhdc $cols VALUES $insert_val;";
        //return $full1 . "\r\n" . $full2;

        $date = date('YmdHis');
        $filename = "rpt_script_$date.sql";
        $file = fopen($filename, "w");
        $txt = $full1 . "\r\n" . $full2;
        fwrite($file, $txt);
        fclose($file);
        $path = Yii::getAlias('@web');
        $myfile = $filename;
        \Yii::$app->response->sendFile($myfile);
    }

    
    
}
