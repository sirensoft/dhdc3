<?php

namespace modules\sync\controllers;

use yii\web\Controller;
use yii\helpers\Html;

/**
 * Default controller for the `sync` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $json = file_get_contents('http://xx.xx.22.108:3001/api/sql');
        return $this->render('index', [
                    'data' => json_decode($json, TRUE)
        ]);
    }

    public function actionSyncAll() {
        $json = file_get_contents('http://xx.xx.22.108:3001/api/sql');
        $array = json_decode($json, TRUE);       
        foreach ($array as $val) {
            if ($val['active'] == 1 && $val['sync_all']==1) {
                $sql = $val['sql'];
                $table = $val['table'];
                $raw = \Yii::$app->db->createCommand($sql)->queryAll();
                $keys = array_keys($raw[0]);
                foreach ($raw as $v) {
                    $data = [];
                    foreach ($keys as $k) {
                        $data[$k] = $v[$k];
                    }
                    $this->sendPost($table, $data);
                }
                echo $val['id'].'<br>';
            }
        }
        return 'OK';
    }

    protected function sendPost($table, $data) {
        $url_api = "http://xx.xx.22.108:3001/api/send/$table";
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url_api, false, $context);
        if ($result === FALSE) {
            return $result;
        }
        return $result;
    }

    public function actionPost($table, $sql) {
        $this->layout = 'hdc';
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $keys = array_keys($raw[0]);

        foreach ($raw as $val) {
            $data = [];
            foreach ($keys as $k) {
                $data[$k] = $val[$k];
            }
            $this->sendPost($table, $data);
        }


        return $this->render('post', [
                    'raw' => $raw
        ]);
    }
    
    // เรียก client ทั้งหมดให้ส่ง โดยตั้งไว้ที่ cronjob
    /*
    public function actionAll(){
        $sql = "select * from cserver where skip <> '1'";
        $array = MyHelper::queryAll($sql);
        foreach ($array as $val) {
            $json = file_get_contents($val['url']);
            $id = $val['id'];
            $sql = "update cserver t set t.last_sync = now() where t.id = '$id'";
            MyHelper::execute($sql);
        }
        $sql = "update csync_date set sync_date=now()";
        MyHelper::execute($sql);
        return 'Sync-All-Server ... OK';
    }
 
     */

}
