<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Hdcsql */

$this->title = $model->rpt_id;
$this->params['breadcrumbs'][] = ['label' => 'Hdcsqls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<i class="btn-cyan"></i>
<div class="hdcsql-view">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> แก้ไข', ['update', 'id' => $model->rpt_id], ['class' => 'btn btn-teal']) ?>
        <?=
        Html::a('<i class="glyphicon glyphicon-file"></i> ส่งออก', ['export', 'id' => $model->rpt_id], [
            'class' => 'btn btn-cyan',
            //'data'=>['method'=>'post'],
            'target' => '_blank'
        ])
        ?>
        <?=
        Html::a('<i class="glyphicon glyphicon-remove"></i> ลบ', ['delete', 'id' => $model->rpt_id], [
            'class' => 'btn btn-red pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>


    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rpt_id',
            'rpt_name',
            'sql_sum:ntext',
            'sql_indiv:ntext',
            'sql_check:ntext',
            'tb_source',
            'dupdate',
            'note1',
            'note2',
            'note3',
        ],
    ])
    ?>

</div>
