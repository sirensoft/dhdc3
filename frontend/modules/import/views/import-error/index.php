<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\import\models\SysDhdcImportErrorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label'=>'รายการไฟล์','url'=>['/import/upload/index']];
$this->params['breadcrumbs'][] = 'ข้อผิดพลาด';
?>
<div class="sys-dhdc-import-error-index">

   
    <?= GridView::widget([
        'responsiveWrap'=>false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date_err',
            [                
                'attribute'=>'err',
                'format'=>'ntext',
                //'width'=>'100px'
            ],

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>
</div>
