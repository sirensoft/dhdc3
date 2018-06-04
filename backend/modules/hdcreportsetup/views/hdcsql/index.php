<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HdcsqlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการรายงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<i class="btn-teal"></i>
<div class="hdcsql-index">


    <?=
    GridView::widget([
        'id' => 'my-grid',
        'panel' => ['before' => '','type'=>'primary'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => FALSE,
        'toolbar' => [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่ม', ['create'], ['class' => 'btn btn-default btn-create']) .
                '{toggleData}'. 
                '{export}'
            ],
        ],
        'options' => [ 'style' => 'table-layout: fixed; width: 100%' ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //['class'=>'\yii\grid\CheckboxColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-search"></i>', $url, [
                                    'title' => 'view', 'class' => 'btn btn-teal'
                        ]);
                    },]
                    ],
                    [
                        'attribute' => 'rpt_id',
                        //'contentOptions' => ['style' => 'word-wrap: break-word']
                    ],
                    [
                        'attribute' => 'rpt_name',
                        'contentOptions' => ['style' => 'word-wrap: break-word']
                    ],
                //'sql_indiv:ntext',
                //'sql_sum:ntext',
                //'sql_check:ntext',
                // 'tb_source',
                // 'dupdate',
                // 'note1',
                // 'note2',
                // 'note3',
                ],
            ]);
            ?>

</div>





