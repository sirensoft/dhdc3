<?php


use yii\helpers\Html;



$this->params['breadcrumbs'][] = ['label' => 'รายหน่วยบริการ' , 'url' => ['hos-sum-error']];
$this->params['breadcrumbs'][] = 'คุณภาพข้อมูลของหน่วยบริการ '.$hospcode;
?>
<h4><?=$byear?></h4>
<div>
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'hover' => true,
        //'pjax' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'responsiveWrap' => FALSE,
        //'floatHeader' => true,
        'panel' => [
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_DANGER,
        ],
        'columns' => [

            ['attribute' => 'FILE'],
            ['attribute' => 'TOTAL'],
            [
                'attribute' => 'ERR',
                'format' => 'raw',
                'label' => 'ERR',
                'value' => function($data) {
                    return Html::a($data['ERR'], [
                                'data-error',
                                'hospcode' => $data['HOSPCODE'],
                                'filename' => $data['FILE'],
                                'from' => 'hos-file'
                    ]);
                }
                    ],
                    ['attribute' => 'QC', 'label' => 'คุณภาพ'],
                ]
            ]);
            ?>
</div>