<?php

namespace backend\modules\exec\controllers;


use yii\web\Controller;
use common\models\config\SysProcessRunning;

class TransformController extends Controller {

      

    public function actionSetup() {
        $this->exec_sql("CALL z_sys_process_running_false;");
        $this->transform_init();
        return 'success..ok';
    }

    public function actionExec() {
        $running = SysProcessRunning::find()->one();
        if($running->is_running == 'true'){
            return "ไม่สามารถดำเนินการได้ process is running";
        }
       
        $this->transform_init();
        sleep(5);
        $sql = "call sys_transform_all();";
        try {
            $this->exec_sql($sql);
        } catch (yii\db\Exception $e) {
            return $e->getMessage();
        }
        return 'ประมวลผลเสร็จสมบูรณ์';
    }

    protected function transform_init() {
        // clone report
        $this->exec_sql("REPLACE INTO sys_reportcategory_dhdc (SELECT * from sys_reportcategory);");
        $this->exec_sql("DROP TABLE IF EXISTS sys_report_dhdc;");
        $this->exec_sql("CREATE TABLE sys_report_dhdc (SELECT * FROM sys_report t WHERE t.id NOT IN (SELECT id FROM sys_report_drop));");
        $this->exec_sql("UPDATE sys_report_drop t ,sys_report_dhdc s set t.rpt = s.report_name WHERE t.id = s.id;");
        //end clone
        
        $sql = " CREATE TABLE IF NOT EXISTS `sys_transform_all` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) DEFAULT NULL,
  `t_sql` longtext,
  `active` varchar(1) DEFAULT '1',
  `bycase` varchar(15) DEFAULT NULL,
  `version` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8; ";
        $this->exec_sql($sql);
        sleep(5);

        $sql = "TRUNCATE sys_transform_all;";
        $this->exec_sql($sql);
        $sql = "INSERT INTO sys_transform_all (SELECT '',t.t_name,t.t_sql,t.active,t.bycase,t.version FROM sys_transform t  ORDER BY t.id);";
        $this->exec_sql($sql);
        $sql = "INSERT INTO sys_transform_all (SELECT '',t.t_name,t.t_sql,t.active,t.bycase,t.version FROM sys_transform_plus t  ORDER BY t.id);";
        $this->exec_sql($sql);

        $databases = "SELECT DATABASE() as db;";
        $databases = \Yii::$app->db->createCommand($databases)->queryOne();
        $databases = $databases['db'];

        $provcode = "select provcode from sys_config_main limit 1";
        $provcode = \Yii::$app->db->createCommand($provcode)->queryOne();
        $provcode = $provcode['provcode'];

        $sql = " select t.* from sys_transform_all t
WHERE  t.bycase NOT IN ('dbpop')
AND t.t_name NOT IN ('t_update_tb','count_43tables')
ORDER BY t.id ASC ";

        $raw = $this->query_all($sql);

        $command_t = "CREATE PROCEDURE sys_transform_all()\r\n ";
        $command_t.= "BEGIN\r\n";
        $command_t.= "# build at " . date('Y-m-d H:i:s') . "\r\n";
        $command_t.= "CALL start_process;\r\n";
        $command_t.= "UPDATE sys_check_process t set t.fnc_name = 'sys_transform_all' , t.time = NOW();\r\n";
        $command_t.= "TRUNCATE hdc_log;\r\n";
        $command_t.= "INSERT INTO hdc_log(p_date,p_name)values(now(),'start');\r\n";
        $command_t.= "#start here\r\n\r\n";


        foreach ($raw as $value) {

            $id = $value['id'];
            $t_sql = $value['t_sql'];
            $t_name = $value['t_name'];
            if ($t_sql && $t_name) {
                $t_sqls = stripslashes($t_sql);
                $t_sqls = str_replace("%", "%%", $t_sqls);
                $t_sqls = str_replace("%%s", "%s", $t_sqls);

                if ($t_sqls && trim($t_sqls) != "") {
                    $t_sqls = sprintf($t_sqls, $provcode, $id, $databases, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                    if (substr(trim($t_sqls), -1) != ";" && $t_sqls != "") {
                        $t_sqls .=";";
                    } else {
                        $t_sqls = $t_sqls;
                    }
                }


                try {

                    $this->exec_sql("DROP PROCEDURE IF EXISTS $t_name");

                    $sp_build = "CREATE PROCEDURE $t_name()\r\n";
                    $sp_build.=" BEGIN \r\n";
                    $sp_build.= $t_sqls;
                    $sp_build.="\r\n END";

                    $this->exec_sql($sp_build);
                } catch (\yii\db\Exception $e) {
                    return $e->getMessage();
                }
                // echo $t_sqls;

                $command_t.="INSERT INTO hdc_log(p_date,p_name)values(now(),'$t_name');\r\n";

                $command_t.="CALL $t_name;\r\n";


                //echo "<hr>";
            }
        }// end loop
        $command_t.= "CALL last_transform;\r\n";
        $command_t.= "\r\n#end here\r\n";
        $command_t.= "INSERT INTO hdc_log(p_date,p_name)values(now(),'end');\r\n";
        
        $command_t.= "CALL end_process; \r\n";
        $command_t.= "\r\n END";
        $this->exec_sql("DROP PROCEDURE IF EXISTS sys_transform_all;");
        $this->exec_sql($command_t);
        

        //
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
