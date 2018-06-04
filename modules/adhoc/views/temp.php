<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\drugdata\models\DrugdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลผู้แพ้ยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drugdata-index">



    <p>
        <?= Html::a('นำเข้า Excel', ['/import/excel/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [ 'befor' => ''],
        'responsiveWrap' => false,
        'options' => [ 'style' => 'table-layout: fixed; width: 100%'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'pcucode',
            [
                'attribute' => 'pcucode',
                'label' => 'สถานบริการ',
                'filter' => FALSE,
                'contentOptions' => ['style' => 'min-width: 180px;'],
                'value' => function($model) {
            return $model->hosname;
        },
            ],
            [
                'attribute' => 'daterecord',
                'filter' => FALSE,
                'format' => 'date',
                'contentOptions' => ['style' => 'min-width: 100px;'],
                'value' => function($model) {
            return $model->daterecord;
        },
            ],
            [
                'attribute' => 'cardid',
                'format' => 'Html',
                'contentOptions' => ['style' => 'min-width: 350px;max-width: 350px;'],
                'value' => function($model) {
            return Html::a('<i class="glyphicon glyphicon-search"></i> ' . $model->cardid, ['/drugdata/drugdata/drugview',
                        'cardid' => $model->cardid,
                        'sexname' => $model->sexname,
                        'ptdob' => $model->ptdob,
                        'fullname' => $model->pttitle . " " . $model->ptfname . " " . $model->ptlname,
                            ]
            );
        },
            ],
            [
                'attribute' => 'ptfname',
                'label' => 'ชื่อ-สกุล',
                'contentOptions' => ['style' => 'min-width: 350px;'],
                'value' => function($model) {
            return $model->pttitle . " " . $model->ptfname . " " . $model->ptlname
            ;
        },
            ],
            [
                'attribute' => 'listname',
                'filter' => FALSE,
                'contentOptions' => ['style' => 'min-width: 300px;word-wrap: break-word;'],
                'value' => function($model) {
            return $model->listname;
        },
            ],
            [
                'attribute' => 'listsign',
                'filter' => FALSE,
                'contentOptions' => ['style' => 'min-width: 300px;word-wrap: break-word;'],
                'value' => function($model) {
            return $model->listsign;
        },
            ],
            [
                'attribute' => 'pharmacist',
                'filter' => FALSE,
                'contentOptions' => ['style' => 'min-width: 180px;word-wrap: break-word;'],
                'value' => function($model) {
            return $model->pharmacist;
        },
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => ' {view}',],
        ],
    ]);
    ?>
</div>
