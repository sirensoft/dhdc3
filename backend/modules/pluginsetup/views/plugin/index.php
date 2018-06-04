<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\plugin\models\SysDhdcPluginSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการ Plugin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-dhdc-plugin-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่ม', ['create'], ['class' => 'btn btn-blue']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            'mod_name',
            'route',
            [
                'attribute'=>'type',
                'filter'=>['app'=>'App','module'=>'Module']
            ],
            [
                'attribute'=>'status',
                'filter'=>['on'=>'On','off'=>'Off']
            ],
            'created_at:datetime:วันที่เพิ่ม',
            'updated_at:datetime:ปรับปรุงเมื่อ',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'buttons'=>[
                    'view'=>function($url,$model){
                        return Html::a('<i class="glyphicon glyphicon-search"></i>',$url,['class'=>'btn btn-gray']);
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
