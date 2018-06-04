<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $zipname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการไฟล์ '), 'url' => ['index']];
$this->params['breadcrumbs'][] = $zipname;
?>
<div class="detail-fortythree-view">
    <?php
    //echo $zipname = $model['filename'];

    $sql = " SELECT t.FILE_NAME,t.TOTAL_RECORD
,t.IMPORT_DATE FROM sys_count_import_file t WHERE t.ZIP_NAME = '$zipname'; ";
    $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

    if (!empty($rawData[0])) {
        $cols = array_keys($rawData[0]);
    }

    $data_grid = new \yii\data\ArrayDataProvider([
        //'key' => 'hoscode',
        'allModels' => $rawData,
        'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
        'pagination' => FALSE,
    ]);

    echo \kartik\grid\GridView::widget([
        'dataProvider' => $data_grid,
        'summary' => "",
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
    ]);
    ?>


</div>



