<?php

use yii\helpers\Html;
use components\MyHelper;
use miloschuman\highcharts\HighchartsAsset;
use yii\helpers\ArrayHelper;
use common\models\config\ChospitalAmp;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\grid\GridView;

HighchartsAsset::register($this)->withScripts([
    'highcharts-more',
    'themes/grid'
]);
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลประชากร', 'url' => ['index']];
$this->params['breadcrumbs'][] = "แบ่งตาม TYPEAREA";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'responsiveWrap' => false,
    'panel' => ['before' => 'ข้อมูลประชากรที่ยังมีชีวิตอยู่แบ่งตาม TYPEAREA'],
]);




