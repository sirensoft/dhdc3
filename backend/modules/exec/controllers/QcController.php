<?php

namespace backend\modules\exec\controllers;

use yii\web\Controller;
use common\models\config\SysProcessRunning;
use frontend\modules\import\models\SysFiles;

class QcController extends Controller {

    public function actionExec() {
        $running = SysProcessRunning::find()->one();
        if ($running->is_running == 'true') {
            return "ไม่สามารถดำเนินการได้ process is running";
        }

        //sleep(5);
        $sql = "call err_all();";
        try {
            $this->exec_sql($sql);
        } catch (yii\db\Exception $e) {
            return $e->getMessage();
        }
        return 'ประมวลผลเสร็จสมบูรณ์';
    }

    public function actionTruncate() {
        ini_set('max_execution_time', 0);

        if (\Yii::$app->user->can('Admin')) {

            $model = SysFiles::find()->asArray()->all();
            foreach ($model as $m) {
                $table = $m['file_name'];
                $sql = "truncate $table";
                \Yii::$app->db->createCommand($sql)->execute();

                //$sql = "truncate dhdc_tmp_$table";
                //\Yii::$app->db->createCommand($sql)->execute();
                //echo $sql . "<br>";
            }

            $this->exec_sql("truncate sys_upload_fortythree;");
            $this->exec_sql("truncate sys_count_import;");
            $this->exec_sql("truncate  sys_count_import_file;"); 
            sleep(3);
            $this->exec_sql("call err_all();");
            sleep(3);
            $this->exec_sql("call sys_transform_all();");
            
            return "Truncate is success.!";
        } else {
            return "You is not Admin.";
        }
    }

    protected function exec_sql($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function query_all($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    protected function query_one($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->queryOne();
    }

}
