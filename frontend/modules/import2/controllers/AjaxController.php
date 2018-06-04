<?php

namespace frontend\modules\import2\controllers;

use yii;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use frontend\modules\import\models\UploadFortythree;
use yii\db\Exception;
use frontend\modules\import\models\SysFiles;
use frontend\modules\import\models\SysFileNotImport;
use yii\db\Expression;

class AjaxController extends \yii\web\Controller {

    protected function add_log_err($log_err) {
        $dt = date('Y-m-d H:i:s');
        $log_err = str_replace("'", "", $log_err);
        $log_err = str_replace("\"", "", $log_err);

        $sql = " INSERT INTO sys_dhdc_import_error (date_err, err) VALUES ('$dt', '$log_err')";
        \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    protected function loaddata($txtfile, $table, $zip_file_name, $stat = 1) {
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //raw
            $sql = "LOAD DATA LOCAL INFILE '$txtfile'";
            $sql.= " REPLACE INTO TABLE $table";
            //$sql.= " CHARACTER SET UTF8";
            $sql.= " FIELDS TERMINATED BY '|'  LINES TERMINATED BY '\r\n' IGNORE 1 LINES";
            $raw = \Yii::$app->db->createCommand($sql)->execute();

            if ($stat == 1) {
                //tmp                        
                $sql = "LOAD DATA LOCAL INFILE '$txtfile'";
                $sql.= " REPLACE INTO TABLE dhdc_tmp_$table";
                //$sql.= " CHARACTER SET UTF8";
                $sql.= " FIELDS TERMINATED BY '|'  LINES TERMINATED BY '\r\n' IGNORE 1 LINES";
                $sql.= " SET NOTE1='$zip_file_name',NOTE2=NOW()";
                $tmp = \Yii::$app->db->createCommand($sql)->execute();

                // count
                $sql = " REPLACE  INTO sys_count_import_file  (
                                 SELECT IF(NOTE1 is NULL,'$zip_file_name','$zip_file_name'),'$table',COUNT(*),NOW(),'','','' FROM dhdc_tmp_$table
                                 WHERE NOTE1 = '$zip_file_name'
                            );  ";
                \Yii::$app->db->createCommand($sql)->execute();

                $sql = "DELETE FROM dhdc_tmp_$table WHERE NOTE1 = '$zip_file_name' ";
                \Yii::$app->db->createCommand($sql)->execute();
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();

            throw $e;
        }
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionImport($fortythree, $upload_date, $upload_time, $id) {

        ini_set('max_execution_time', 0);

        $zip = new \ZipArchive();

        if (strncasecmp(PHP_OS, 'WIN', 3) === 0) {
            //$path_zip = 'fortythree';
            //$path_unzip = 'unzip';
            $path_zip = \Yii::getAlias('@webroot') . "/fortythree";
            $path_unzip = \Yii::getAlias('@webroot') . "/unzip";
        } else {
            $path_zip = \Yii::getAlias('@webroot') . "/fortythree/";
            $path_unzip = \Yii::getAlias('@webroot') . "/unzip/";
        }

        $model = UploadFortythree::findOne($id);
        $model->note2 = 'กำลังนำเข้า';
        $model->update(FALSE);

        $file_zip = $path_zip . '/' . $fortythree;
        $zip_file_name = basename($file_zip);

        if ($zip->open($file_zip, \ZipArchive::CHECKCONS) !== TRUE) {

            $model->note2 = 'zip err';
            $model->update(FALSE);
            $this->add_log_err("Can not open $file_zip");
            return "Can not open $file_zip.";
        }
        $path_unzip_ = $path_unzip . '/' . basename($file_zip);
        $zip->extractTo($path_unzip_);
        $zip->close();
        // อ่านไฟล์และนำเข้า

        $txtFiles = FileHelper::findFiles($path_unzip_, [
                    'only' => ['*.txt', '*.TXT'],
                    'recursive' => TRUE,
        ]);

        foreach ($txtFiles as $file) {

            $info = pathinfo($file);

            $table = strtolower($info['filename']);
            //echo "\t reading..." . $table . "\r\n";

            $file = str_replace("\\", "/", $file);
            $model->note3 = basename($file);

            $model->update(FALSE);
            // importing
            try {
                $this->loaddata($file, $table, $zip_file_name, 1);
                unlink($file);
            } catch (Exception $ex) {
                $log_err = $ex->getMessage();
                $this->add_log_err($log_err);
                $this->deleteDirectory($path_unzip_);
                $model->note2 = 'ผิดพลาด';
                $model->update(FALSE);
                return "ERROR $file";
                //break;
            }


            // end importing
        }

        $this->deleteDirectory($path_unzip_);
        unlink($file_zip);

        //จบอ่านและนำเข้า
        $model->note3 = '';
        $model->note2 = 'OK';
        $model->update(FALSE);

        return "นำเข้า " . $fortythree . " สำเร็จ";
    }

    public function actionImportAll($fortythree, $upload_date, $upload_time) {

        ini_set('max_execution_time', 0);

        $zip = new \ZipArchive();

        if (strncasecmp(PHP_OS, 'WIN', 3) === 0) {
            //$path_zip = 'fortythree';
            //$path_unzip = 'unzip';
            $path_zip = \Yii::getAlias('@webroot') . "/fortythree";
            $path_unzip = \Yii::getAlias('@webroot') . "/unzip";
        } else {
            $path_zip = \Yii::getAlias('@webroot') . "/fortythree/";
            $path_unzip = \Yii::getAlias('@webroot') . "/unzip/";
        }

        $file_zip = $path_zip . '/' . $fortythree;
        $file_size = number_format(filesize($file_zip) / (1024 * 1024), 3);
        $zip_file_name = basename($file_zip);

        if ($zip->open($file_zip, \ZipArchive::CHECKCONS) !== TRUE) {
            $this->add_log_err("Can not open $file_zip.");
            return "Can't open $file_zip.";
        }
        $path_unzip_ = $path_unzip . '/' . basename($file_zip);
        $zip->extractTo($path_unzip_);
        $zip->close();
        // อ่านไฟล์และนำเข้า

        $txtFiles = FileHelper::findFiles($path_unzip_, [
                    'only' => ['*.txt', '*.TXT'],
                    'recursive' => TRUE,
        ]);

        foreach ($txtFiles as $file) {

            $info = pathinfo($file);

            $table = strtolower($info['filename']);
            //echo "\t reading..." . $table . "\r\n";

            $file = str_replace("\\", "/", $file);

            // importing
            try {
                $this->loaddata($file, $table, $zip_file_name, 0);
                unlink($file);
            } catch (Exception $ex) {
                $log_err = $ex->getMessage();
                $this->add_log_err($log_err);
                $this->deleteDirectory($path_unzip_);
                return "ERROR $file";
            }



            // end importing
        }

        $this->deleteDirectory($path_unzip_);
        unlink($file_zip);

        //จบอ่านและนำเข้า

        $upload = new UploadFortythree;
        $upload->file_name = $fortythree;
        $upload->file_size = $file_size;
        $upload->upload_date = date('Y-m-d');
        $upload->upload_time = date('H:i:s');
        $upload->note2 = 'OK';
        $upload->note3 = 'import all';
        $upload->save(FALSE);

        return $fortythree;
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

                echo $sql . "<br>";
            }

            \Yii::$app->db->createCommand("truncate sys_upload_fortythree;")->execute();
            \Yii::$app->db->createCommand("truncate sys_count_import;")->execute();
            \Yii::$app->db->createCommand("truncate  sys_count_import_file;")->execute();
        } else {
            return "Not allow truncate";
        }
    }

    public function actionUpdate() {
        ini_set('max_execution_time', 0);
        if (!\Yii::$app->user->isGuest) {
            $user = Html::encode(Yii::$app->user->identity->username);
            if ($user === 'admin') {
                $sql = "CALL zz_update_upload_log;";
                \Yii::$app->db->createCommand($sql)->execute();
                //return;
                $sql = " select table_name from information_schema.tables  "
                        . " where table_schema='dhdc' AND TABLE_NAME like 'tmp_%'; ";
                $raw = \Yii::$app->db->createCommand($sql)->queryAll();
                //\yii\helpers\VarDumper::dump($raw);
                foreach ($raw as $tb) {
                    $old = $tb['table_name'];
                    $new = "dhdc_" . $old;
                    $sql = " RENAME TABLE $old TO $new ";
                    \Yii::$app->db->createCommand($sql)->execute();
                    echo $sql;
                    echo "<br>";
                }

                echo 'update success.';
            }
        }
    }

}
